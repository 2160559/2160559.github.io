var express    = require('express');
var session    = require('express-session');
var app        = express();
var mysql      = require('mysql');
var bodyParser = require('body-parser');
var path       = require('path');
var mailbox    = require('nodemailer');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));
app.use(express.static('public'));
app.use(session({secret: 'vigilnight', resave: false, saveUninitialized: true, cookie: { maxAge: 60000 }}));

app.set('view engine', 'ejs');

let userID;
let userName, queried, num;
let newSession;

var connection = mysql.createConnection({
  //host     : '192.168.254.112', //ip address
  host     : 'localhost', //comment for demo
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
    console.log('Thank you for using Abang services! You may find us at :8666 ~');
    //console.log('Thank you for using Abang services! You may find us at :80 ~'); //uncomment for demo
});

app.get('/', function (req, res) {
    if (req.session.userName) {
        res.redirect('/home');
    } else {
        userName = "";
        res.render('home');
    }
});

//testing w/o client
app.get('/login', function (req, res) {
    res.render('login');
});

app.get('/home', function (req, res) {
   if (req.session.userName) {
       res.render('yeslog', {name: userName});
   } else {
       res.redirect('/');
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
            userName = result[0].f_name + result[0].l_name;
            newSession = req.session;
            newSession.userName = userName;
            newSession.email = result[0].email_add;
            newSession.id = req.sessionID;
            res.render('yeslog', {name: userName});
        }
    });
});

app.get('/register', function(req, res) {
    if (!req.session.userName) {
        res.render('register', {title: "Register as a Service Provider!"});
    } else {
        res.redirect('/home');
    }
});

app.post('/register', function(req, res){
    var rName = req.body.fname;
    var rSurname = req.body.lname;
    var rGender = req.body.gender;
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
    var rPermit = req.body.permit;
    var rBank = req.body.cardno;
    var rAddress = rHouseNo+" "+rStreet+" "+rBarangay+" "+rCity+" "+rProv+" "+rRegion;
    
    connection.query("INSERT INTO users (username, f_name, l_name, email_add, password, phone, acc_type, profile_img, birthday) VALUES (?,?,?,?,?,?,?,?,?)", [rUsername, rName, rSurname, rEmail, rPass, rContact, "provider", null, rBD], function(err, rows) {
        if(err) throw err;
    });
    
    connection.query("SELECT * FROM users WHERE username = ? AND f_name = ? AND l_name = ?", [rUsername, rName, rSurname], function(err, rows) {
        if(err) throw err;
        userID = rows[0].id;
        userName = rName+" "+rSurname;
        res.render('yeslog', {name: userName});
        connection.query("INSERT INTO `service-provider` (id, address, `business-permit`, `bank-acc-no`) VALUES (?,?,?,?)", [userID, rAddress, rPermit, rBank], function(err, rows){
           if (err) throw err;
        });
    });
    
    res.render('yeslog', {name: userName});
});

app.get('/listings', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        connection.query("SELECT house.id as 'houseid', COUNT(*) 'countroom', house.address, room.area, house.no_CR, room.no_beds, IF(bookings.id IS NULL, 'AVAILABLE', 'BOOKED') as 'status' FROM (house INNER JOIN room ON house.id = room.house_id) LEFT JOIN bookings ON bookings.`room-id` = room.id WHERE house.`service-provider` = ? GROUP by 1", userID, function(err, rows) {
            if(err) throw err;
            res.render('listings', {title: "Your Listings", data: rows, uid: userID});
        });
    }
});

app.get('/listings/:uid/:hid', function(req, res) {
    if (!req.session.userName) {
        res.redirect('/');
    } else {
        var pid = req.params.uid, hid = req.params.hid;
        connection.query("SELECT *, concat('data:image;base64,', TO_BASE64(image)) as image FROM house join `house-images` on house.id = `house-images`.`house-id` WHERE house.`service-provider` = ? AND house.id = ?", [pid, hid], function(err, rows) {
            if(err) throw err;
            res.render('listingdes', {list: rows});
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
   
    connection.query("INSERT INTO house (`service-provider`, address, no_CR,longitude,latitude, name, description,rules, amenities,cancellations,price,no_room) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", [userID,adds,noCR,longi,lati,name1,descrip,ru,ame,pol,price1,noRoom], function(err, rows) {
        if(err) throw err;
            res.render('yesadd', {title: "Congrats!"});
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

app.get('/signout', function(req, res) {
    req.session.destroy();
    res.redirect('http://www.abang.com/index.php');
});

/* EMAIL */

app.post('/c/forget', function(req, res) { // client forget password
    var email = req.body.email_add;

    var mailOptions = {
        from: '"Abang" official.abang@gmail.com',
        to: `${email}`,
        subject: 'Account Confirmation',
        html: '<h1>Reset Password</h1><p>does this work</p>'
    };
    
    mailman.sendMail(mailOptions, function(error, info){
        if (error) {
            console.log(error);
        } else {
            res.send(`<p>email sent</p>`); // test
            //res.redirect('http://');
        }
    });
});

