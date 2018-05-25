var express      = require('express');
var session      = require('express-session');
var app          = express();
var mysql        = require('mysql');
var bodyParser   = require('body-parser');
var path         = require('path');
var mailbox      = require('nodemailer');
var pwHash       = require('password-hash');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));
app.use(express.static('public'));
app.use(session({secret: 'vigilnight', resave: false, saveUninitialized: true, cookie: { maxAge: 6000000 }}));

app.set('view engine', 'ejs');

let userID;
let userName, queried, num;
let newSession;

var connection = mysql.createConnection({
    //host     : '192.168.254.108', //ip address
    host     : 'localhost',
    user     : 'root',
    password : '',
    database : 'transient'
});

var mailman = mailbox.createTransport({
  service: 'gmail',
  auth: {
    user: 'official.abang@gmail.com',
    pass: 'webtech2018'
  }
});

connection.connect();

app.listen(8666, function() {
//app.listen(80, '0.0.0.0', function () { //uncomment for demo
    console.log('Thank you for using Abang services!'); //uncomment for demo
});

// if logged in, show dash; if not, redirect to client
app.get('/', function (req, res) {
    if (req.session.userName) {
        res.render('home', {user: req.session.userName});
    } else {
        res.redirect('http://www.abang.com/index.php')
    }
});

app.post('/providerlogin', function(req, res) {
    var email = req.body.email_add.toString();
    var pass = req.body.password;
    connection.query("SELECT * FROM `users` WHERE email_add = ? AND password = ?", [email, pass], function(err, result) {
        if(err) throw err;
        if (result.length == 0) {
            res.render('nolog');
        } else {
            userID = result[0].id;
            userName = result[0].f_name +" "+ result[0].l_name;
            newSession = req.session;
            newSession.userName = userName;
            newSession.email = result[0].email_add;
            newSession.id = req.sessionID;
            res.render('home', {user: userName});
        }
    });
});

app.get('/register', function(req, res) {
    if (!req.session.userName) {
        res.render('register', {title: "Register as a Service Provider!"});
    } else {
        res.redirect('/');
    }
});

app.post('/register', function(req, res){
    var rName = req.body.fname;
    var rSurname = req.body.lname;
    var rBD = req.body.birthdate; // format: year-mm-dd
    var rRegion = req.body.item1;
    var rProv = req.body.item2;
    var rCity = req.body.item3;
    var rBarangay = req.body.brgy;
    var rStreet = req.body.street;
    var rHouseNo = req.body.houseno;
    var rContact = req.body.contact;
    var rUsername = req.body.username;
    var rEmail = req.body.email;
    var rPass = req.body.password;
    var rHash = pwHash.generate(rPass);
    var rPermit = req.body.permit;
    var rBank = req.body.cardno;
    var rAddress = rHouseNo+" "+rStreet+" "+rBarangay+" "+rCity+" "+rProv+" "+rRegion;
    
    // insert as user
    connection.query("INSERT INTO users (username, f_name, l_name, email_add, password, phone, acc_type, profile_img, birthday, status) VALUES (?,?,?,?,?,?,?,?,?,?)", [rUsername, rName, rSurname, rEmail, rHash, rContact, "provider", null, rBD, "pending"], function(err, rows) {
        if(err) throw err;
    });
    
    // get user id and insert as provider
    connection.query("SELECT * FROM users WHERE username = ? AND f_name = ? AND l_name = ?", [rUsername, rName, rSurname], function(err, rows) {
        if(err) throw err;
        userID = rows[0].id;
        userName = rName+" "+rSurname;
        connection.query("INSERT INTO `service-provider` (id, address, `business-permit`, `bank-acc-no`) VALUES (?,?,?,?)", [userID, rAddress, rPermit, rBank], function(err, rows){
           if (err) throw err;
        });
    });

    res.render('yesreg', {email: rEmail});
});

app.get('/listings', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        connection.query("SELECT DISTINCT house.id, house.address, house.no_CR, house.name, house.no_room, concat('data:image;base64,', TO_BASE64(`house-images`.image)) as coverimg FROM (house CROSS JOIN `service-provider` on `house`.`service-provider` = `service-provider`.`id`) JOIN `house-images` ON house.cover_image = `house-images`.`id` WHERE `service-provider`.`id` = ?", [userID], function(err, rows) {
            if(err) throw err;
            res.render('listings', {title: "Your Listings", data: rows, uid: userID});
        });
    }
});
app.get('/acctdets', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        connection.query(" SELECT username,f_name,l_name,email_add,password,phone,birthday FROM users WHERE id = ?", userID, function(err, rows) {
            if(err) throw err;
            res.render('profile', {title: "Your Profile", data: rows});
        });
    }
});

app.get('/listings:uid:hid', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        var pid = req.params.uid, hid = req.params.hid;
        connection.query("SELECT DISTINCT house.name, house.address, house.description, house.rules, house.amenities, house.cancellations, house.price, concat('data:image;base64,', TO_BASE64(`house-images`.image)) as coverimg FROM ((house CROSS JOIN `service-provider` ON `house`.`service-provider` = `service-provider`.`id`) JOIN `house-images` ON house.cover_image = `house-images`.`id`) LEFT JOIN room on house.id = room.house_id WHERE `service-provider`.id = ? AND house.id = ?", [pid, hid], function(err, rowa) {
            if(err) throw err;
            connection.query("SELECT room.id, room.status FROM (house CROSS JOIN `service-provider` ON house.`service-provider` = `service-provider`.id) CROSS JOIN room ON house.id = room.house_id WHERE house.id = ? AND `service-provider`.id = ?", [hid, pid], function(err, rows) {
                if(err) throw err;
                res.render('listingdes', {house: rowa, room: rows, hid: hid});
            });
        });
    }
});


app.get('/addlist', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        res.render('addtype', {title: "Add A Listing"});
    }
});

app.post('/addlist', function(req, res) {
   var rentType=req.body.yesno;
   var noRoom=req.body.numrooms1;
   var noBeds=req.body.numbeds1;
    var noCR=req.body.numcr1;
    var lati=req.body.lat;
    var longi=req.body.lng;
    var descrip=req.body.description;
    var price1=req.body.presyo;
    var name1=req.body.pname;
    var ame=req.body.hame;
    var ru=req.body.hrules;
    var pol=req.body.hpop;
    var adds=req.body.answer1;
    var houseid;
    
    connection.query("INSERT INTO house (`service-provider`, address, no_CR,longitude,latitude, name, description,rules, amenities,cancellations,price,no_room) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", [userID,adds,noCR,longi,lati,name1,descrip,ru,ame,pol,price1,noRoom], function(err, rows) {
        if(err) throw err;
    });

    connection.query("SELECT * FROM house WHERE `house`.name = ?", name1, function(err, rows) {
        if(err) throw err;
        houseid = rows[0].id;
        connection.query("INSERT INTO `room` (area, no_beds, house_id) VALUES (?,?,?)", ["100", noBeds, houseid], function(err, rows) {
        if(err) throw err;
            res.render('yesadd', {title: "Congrats!"});
            });
    });
});

app.get('/editlist:hid',function(req, res) { 
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        var hid = req.params.hid;
        res.render('editlisting', {msg: "", hid: hid});
    }

});

app.post('/editlist:hid', function(req, res){
    var hid = req.params.hid;
    var selectedOption = req.body.option;
    var editValue = req.body.editshere;
    var sql, toEdit;
    switch(selectedOption) {
    case "1":
        toEdit = "description"; break;
    case "2":
        toEdit = "address"; break;
    case "3":
        toEdit = "rules"; break;
    case "4":
        toEdit = "amenities"; break;
    case "5":
        toEdit = "cancellations"; break;
    case "6":
        toEdit = "price"; break;
        default:
    }
    sql = `UPDATE house SET ${toEdit} = ? WHERE id = ?`;
    connection.query(sql, [editValue, hid], function(err, rows) {
        if(err) throw err;
    });
    res.render('editlisting', {msg: "<script> alert('Edit successful!') </script>"});
});


app.get('/transactions', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        connection.query("select `transaction-date` as `trandate`, amount from transactions where `service-provider-id` = ?", userID, function(err, rows) {
            if(err) throw err;
            res.render('transactions', {title: "Transactions", data: rows, uid: userID});
        });
    }
});

var pending, cancelled, successful, approved, denied;

// imp: pending & approved res
app.get('/reservations', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        connection.query("SELECT reservations.id AS 'resid', `house-name` AS 'name', `room-id` AS 'roomid', `date-reserved` AS 'dateres', `check-in` AS 'checkin', `check-out` AS 'checkout', reservations.status, username FROM reservations JOIN (SELECT room.house_id AS 'house-id', house.name AS 'house-name', room.id AS id, house.`service-provider` AS provider FROM room JOIN house ON room.house_id = house.id) rooms ON `room-id` = rooms.id JOIN users ON `customer-id` = users.id WHERE reservations.status = 'pending' and `provider` = ?", userID, function(err, pen) {
            if(err) throw err;
            pending = pen;
            connection.query("SELECT reservations.id AS 'resid', `house-name` AS 'name', `room-id` AS 'roomid', `date-reserved` AS 'dateres', `check-in` AS 'checkin', `check-out` AS 'checkout', reservations.status, username FROM reservations JOIN (SELECT room.house_id AS 'house-id', house.name AS 'house-name', room.id AS id, house.`service-provider` AS provider FROM room JOIN house ON room.house_id = house.id) rooms ON `room-id` = rooms.id JOIN users ON `customer-id` = users.id WHERE reservations.status = 'approved' and `provider` = ?", userID, function(err, app) {
                if(err) throw err;
                approved = app;
                res.render('reservations', {title: "Reservations", p: pending, a: approved});
            });
        });
    }
});

// history: successful, denied & cancelled
app.get('/reshist', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        connection.query("SELECT reservations.id AS 'resid', `house-name` AS 'name', `room-id` AS 'roomid', `date-reserved` AS 'dateres', `check-in` AS 'checkin', `check-out` AS 'checkout', reservations.status, username FROM reservations JOIN (SELECT room.house_id AS 'house-id', house.name AS 'house-name', room.id AS id, house.`service-provider` AS provider FROM room JOIN house ON room.house_id = house.id) rooms ON `room-id` = rooms.id JOIN users ON `customer-id` = users.id WHERE reservations.status = 'successful' and `provider` = ?", userID, function(err, suc) {
            if(err) throw err;
            successful = suc;
            connection.query("SELECT reservations.id AS 'resid', `house-name` AS 'name', `room-id` AS 'roomid', `date-reserved` AS 'dateres', `check-in` AS 'checkin', `check-out` AS 'checkout', reservations.status, username FROM reservations JOIN (SELECT room.house_id AS 'house-id', house.name AS 'house-name', room.id AS id, house.`service-provider` AS provider FROM room JOIN house ON room.house_id = house.id) rooms ON `room-id` = rooms.id JOIN users ON `customer-id` = users.id WHERE reservations.status = 'denied' and `provider` = ?", userID, function(err, den) {
                if(err) throw err;
                denied = den;
                connection.query("SELECT reservations.id AS 'resid', `house-name` AS 'name', `room-id` AS 'roomid', `date-reserved` AS 'dateres', `check-in` AS 'checkin', `check-out` AS 'checkout', reservations.status, username FROM reservations JOIN (SELECT room.house_id AS 'house-id', house.name AS 'house-name', room.id AS id, house.`service-provider` AS provider FROM room JOIN house ON room.house_id = house.id) rooms ON `room-id` = rooms.id JOIN users ON `customer-id` = users.id WHERE reservations.status = 'cancelled' and `provider` = ?", userID, function(err, can) {
                    if(err) throw err;
                    cancelled = can;
                    res.render('reshistory', {title: "Reservation History", s: successful, d: denied, c: cancelled});
                });
            });
        });
    }
});

// res status: pending > accept
app.get('/ares:resid', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        var resid = req.params.resid;
        connection.query("UPDATE `reservations` SET `status`= 'approved' WHERE `id` = ? AND `status` = 'pending'", resid, function(err) {
            if(err) throw err;
            res.render('yesacc');
        });
    }
});

// res status: pending > denied
app.get('/dres:resid', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        var resid = req.params.resid;
        connection.query("UPDATE `reservations` SET `status`= 'denied' WHERE `id` = ? AND `status` = 'pending'", resid, function(err) {
            if(err) throw err;
            res.render('yesden');
        });
    }
});

// res status: pending > cancelled
app.get('/cres:resid', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        var resid = req.params.resid;
        connection.query("UPDATE `reservations` SET `status`= 'cancelled' WHERE `id` = ? AND `status` = 'pending'", resid, function(err) {
            if(err) throw err;
            res.render('yescan');
        });
    }
});

app.get('/signout', function(req, res) {
    req.session.destroy();
    res.redirect('http://www.abang.com/index.php');
});

/* EMAIL */

app.post('/cforget', function(req, res) { // client forget password
    var email = req.body.email_add;

    var mailOptions = {
        from: `${email}`,
        to: '"Abang" official.abang@gmail.com',
        subject: 'Reset Password',
        html: '<h1>Pleas recover my password! pls :(</h1>'
    };
    
    mailman.sendMail(mailOptions, function(error, info){
        if (error) {
            console.log(error);
        } else {
            console.log(`email to ${email} sent!`);
        }
    });
});

app.post('/conmail', function(req, res) { // confirmation (admin > client/provider)
    var email = req.body.email_add;
    
    var mailOptions = {
        from: '"Abang" official.abang@gmail.com',
        to: `${email}`,
        subject: 'Account Confirmation',
        html: '<h1>Congratulations!</h1><p>Your account for Abang has been approved; you may now log in!</p>'
    };
    
    mailman.sendMail(mailOptions, function(error, info){
        if (error) {
            console.log(error);
        } else {
            console.log(`email to ${email} sent!`);
            res.redirect('http://www.abang.com/login.php');
        }
    });
});
