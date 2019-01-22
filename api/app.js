const bcrypt = require('bcryptjs');
const bodyParser = require('body-parser');
const express = require('express');
const mysql = require('mysql');

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'api',
    password: 'api',
    database : "bde"
});

const app = express();

var user = express.Router();

app.post('/api/register', function (req, res) {
    connection.query('')
})

app.post('/api/connect', function (req, res) {
    var email = req.email;
    var password = req.password;
    var token = bcrypt.hash(email);

    console.log(email + password);
    
    connection.query('SELECT `password` FROM users WHERE `email` = ' + email + '\'', function (err, rows, fields) {
        if (err) throw err;
        console.log(rows);
        bcrypt.compare(password, rows, (err, res) => {
            if (res) {
                connection.query('UPDATE users SET api_token = ' +  token  + ' WHERE email = ' + email + ' AND password = ' + rows);
            }
        });
    });
    res.send({mail: email,
            password: password});
})

user.route('/api/user')
.get(function(req,res){ 
    connection.query('SELECT * FROM `users`', function (err, rows, fields) {
        if (err) throw err;
        res.send({user : rows,
        method: req.method});
    })
})
.post(function (res, req) {
    
})

app.use(user);  

app.listen(3000, 'localhost', function () {
  console.log('Example app listening on port 3000!')
})

