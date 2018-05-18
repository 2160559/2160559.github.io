var express    = require('express');
var session    = require('express-session');
var app        = express();
var mysql      = require('mysql');
var bodyParser = require('body-parser');
var path       = require('path');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));
app.use(express.static('public'));
app.use(session({secret: 'vigilnight', resave: false, saveUninitialized: true, cookie: { maxAge: 60000 }}));

app.set('view engine', 'ejs');

let userID;
let userName, queried, num;
let newSession;

var connection = mysql.createConnection({
  host     : '192.168.254.112', //ip address
  user     : 'root',
  password : '',
  database : 'transient'
});

connection.connect();

app.listen(80, '0.0.0.0', function () {
    console.log('Thank you for using Abang services! You may find us at :80 ~');
});

app.get('/', function (req, res) {
    if (req.session.userName) {
       res.redirect('/home');
    } else {
       res.render('home');
    }
});

app.get('/home', function (req, res) {
   if (req.session.userName) {
       res.render('yeslog', {name: userName});
   } else {
       res.redirect('/');
   }
});

app.post('/providerlogin', function(req, res) {
    //app.use(session({secret: 'vigilnights', resave: false, saveUninitialized: true}));
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
    //res.render('yesadd', {title: "Add A Listing"});
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