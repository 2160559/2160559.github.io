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

var mailman = mailbox.createTransport({
  service: 'gmail',
  auth: {
    user: 'official.abang@gmail.com',
    pass: 'webtech2018'
  }
});

app.listen(8666, function () {
    console.log('Thank you for using Abang services! You may find us at localhost/8666 ~');
});

app.get('/register', function(req, res) {
    res.render('register', {title: "Register as a Service Provider!"});
});

app.get('/listings', function(req, res) {
    res.render('listings', {title: "Your Listings"});
});

app.get('/addlist', function(req, res) {
    res.render('addtype', {title: "Add A Listing"});
});

app.post('/addlist', function(req, res) {
    console.log("listing added to db! well sorta");
    res.render('tba', {title: "Add A Listing"});
});

app.get('/jq-upload', function(req, res) {
    res.sendFile(__dirname + '/public/jq-upload.html');
});

app.get('/transactions', function(req, res) {
    res.render('transactions', {title: "Transactions"});
});

app.post('/register', function(req, res){
    res.render('tba', {title: "Registration To Be Approved"});
});