const express = require('express')
const mysql = require('mysql');

const app = express()
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'api',
    password: 'api',
    database : "bde"
});

app.get('/api/', function (req, res) {

    connection.query('SELECT * FROM `users`', function (err, rows, fields) {
        if (err) throw err;
        res.send({user : rows[0]});
    })
})

app.listen(3000, function () {
  console.log('Example app listening on port 3000!')
})

