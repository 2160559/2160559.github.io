var express    = require('express');
var app        = express();
var mysql      = require('mysql');
var bodyParser = require('body-parser');
var path       = require('path');
var mailbox    = require('nodemailer');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));
app.use(express.static('public'));

app.set('view engine', 'ejs');

//app.get('/', function (req, res) {
//    res.sendFile(__dirname + '/index.html'); send to specific page
//});

let userID = -1;
let userName, queried, num;

var mailman = mailbox.createTransport({
  service: 'gmail',
  auth: {
    user: 'official.abang@gmail.com',
    pass: 'webtech2018'
  }
});

var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'transient'
});

connection.connect();

app.listen(8666, function () {
    console.log('Thank you for using Abang services! You may find us at localhost/8666 ~');
});

/**
 Accessible when redirected from client website
 Checks database and "signs in" providers if credentials are correct
 Optional: hashes (password), sessions
 */
app.post('/login', function(req, res) {
    var email = req.body.email.toString();
    var pass = req.body.password;

    connection.query("SELECT * FROM `users` WHERE email_add = ? AND password = ?", [email, pass], function(err, result) {
        if(err) throw err;
        if (result.length == 0) {
            res.render('nolog');
        } else {
            userID = result[0].id;
            userName = result[0].f_name + result[0].l_name;
            res.render('yeslog', {name: userName});
        }
    });
});

app.get('/register', function(req, res) {
    res.render('register', {title: "Register as a Service Provider!"});
});

/**
 Accessible only when logged in
 Displays all listings of a provider
 */
app.get('/listings', function(req, res) {
    if (userID < 0) {
        res.render('noaccess');
    } else {
        connection.query("SELECT house.id as 'houseid', COUNT(*) 'countroom', house.address, room.area, house.no_CR, room.no_beds, IF(bookings.id IS NULL, 'AVAILABLE', 'BOOKED') as 'status' FROM (house INNER JOIN room ON house.id = room.house_id) LEFT JOIN bookings ON bookings.`room-id` = room.id WHERE house.`service-provider` = ? GROUP by 1", userID, function(err, rows) {
            if(err) throw err;
            res.render('listings', {title: "Your Listings", data: rows, uid: userID});
        });
    }
});

/**
 Optional:
 Accessible only from 'Listings'
 Displays details about each listing
 */
app.get('/listings/:uid/:hid', function(req, res) {
    var pid = res.params.uid,
        hid = res.params.hid;
    //connection.query("SELECT * FROM bookings", [pid, hid], function(err, rows) {
    //    if(err) throw err;
    //    res.render('listingdes', data: rows, uid: userID});
    //});
});

/**
 Accessible only when logged in
 Adds 1 listing
 */
app.get('/addlist', function(req, res) {
    if (userID < 0) {
        res.render('noaccess');
    } else {
        res.render('addtype', {title: "Add A Listing"});
    }
});

app.post('/addlist', function(req, res) {
    console.log("listing added to db! well sorta");
    res.render('tba', {title: "Add A Listing"});
});

/**
 Accessible only when logged in
 Displays all transactions/payments a provider has
 Optional: view review, if any
 */
app.get('/transactions', function(req, res) {
    if (userID < 0) {
        res.render('noaccess');
    } else {
        connection.query("SELECT bookings.id `bookid`, house_id `houseid`, `room-id` `roomid`, payment_id `payid`, house.address, amount, bookings.`customer-id` `custid`, CONCAT(f_name,' ',l_name) `custname` FROM bookings inner join payment on payment.`customer-id`= bookings.`customer-id` inner join users on bookings.`customer-id`=users.id  inner join room on `room-id`=room.id inner join house on house.id=room.house_id where house.`service-provider` = ?", userID, function(err, rows) {
            if(err) throw err;
            res.render('transactions', {title: "Transactions", data: rows, uid: userID});
        });
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
    var rEmail = req.body.email;
    var rPass = req.body.password;
    var rPermit = req.body.permit;
    res.send(`${rName} ${rSurname} is a ${rGender} born on ${rBD} living in ${rCity}, ${rProv}, ${rRegion}`);
});

app.get('/signout', function(req, res) {
    userID = -1;
    res.redirect('http://www.abang.com/index.php');
});