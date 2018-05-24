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
    host     : '192.168.254.114', //ip address
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

//app.listen(8666, function() {
app.listen(80, '0.0.0.0', function () { //uncomment for demo
    //console.log('Thank you for using Abang services! You may find us at :8666 ~');
    console.log('Thank you for using Abang services! You may find us at :80 ~'); //uncomment for demo
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
            res.render('yeslog');
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

app.get('/listings:uid:hid', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        var pid = req.params.uid, hid = req.params.hid;
        connection.query("SELECT DISTINCT house.name, house.address, house.description, house.rules, house.amenities, house.cancellations, house.price, concat('data:image;base64,', TO_BASE64(`house-images`.image)) as coverimg FROM ((house CROSS JOIN `service-provider` ON `house`.`service-provider` = `service-provider`.`id`) JOIN `house-images` ON house.cover_image = `house-images`.`id`) LEFT JOIN room on house.id = room.house_id WHERE `service-provider`.id = ? AND house.id = ?", [pid, hid], function(err, rowa) {
            if(err) throw err;
            connection.query("SELECT room.status FROM (house CROSS JOIN `service-provider` ON house.`service-provider` = `service-provider`.id) CROSS JOIN room ON house.id = room.house_id WHERE house.id = ? AND `service-provider`.id = ?", [hid, pid], function(err, rows) {
                if(err) throw err;
                res.render('listingdes', {house: rowa, room: rows});
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

app.get('/transactions', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        connection.query("SELECT house.address, amount, CONCAT(f_name,' ',l_name) `custname` FROM bookings inner join payment on payment.`customer-id`= bookings.`customer-id` inner join users on bookings.`customer-id`=users.id  inner join room on `room-id`=room.id inner join house on house.id=room.house_id where house.`service-provider` = ?", userID, function(err, rows) {
            if(err) throw err;
            res.render('transactions', {title: "Transactions", data: rows, uid: userID});
        });
    }
});

app.get('/reservations', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        connection.query("SELECT * from reservations join `service-provider` where `service-provider`.id = ?", userID, function(err, rows) {
            if(err) throw err;
            res.render('reservations', {title: "Reservations", data: rows, uid: userID});
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
        from: '"Abang" official.abang@gmail.com',
        to: `${email}`,
        subject: 'Reset Password',
        html: '<h1></h1>'
    };
    
    mailman.sendMail(mailOptions, function(error, info){
        if (error) {
            console.log(error);
        } else {
            console.log(`email to ${email} sent!`);
            //res.redirect('http://');
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
