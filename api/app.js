const bcrypt = require('bcryptjs'); // Encryption module
const express = require('express'); // Server module
const mysql = require('mysql'); // MySQL module
const Joi = require('joi'); // Input validation module

// Database connection
const database = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: "bde"
});

// App instantiation
const app = express();
app.use(express.json());

// Auth
app.post('/api/inscription', (req, res) => {
    database.query('')
});

app.post('/api/connection', (req, res) => {
    // Validation schema
    const schema = {
        email: Joi.string().required(),
        password: Joi.string().required()
    };

    // If body follows schema
    if (Joi.validate(req.body, schema)) {
        // Get credentials
        var email = req.body.email;
        var password = req.body.password;

        // Prepare sql statement
        var sql = 'SELECT * FROM users WHERE email = ' + database.escape(email);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                // Hash and compare passwords
                bcrypt.compare(password, results[0].password, (err, result) => {
                    if (result) { // Passwords match
                        return res.send({
                            connected: 'true',
                            token: results[0].api_token
                        });
                    }
                    else {
                        return res.send({
                            connected: 'false',
                            token: null
                        });
                    }
                });
            }
            else { // Wrong email
                return res.send({
                    connected: 'false',
                    token: null
                });
            }
        });
    }
    else {
        return res.send({
            connected: 'false',
            token: null
        });
    }
});

// app.get('/api/user')
// .get(function(req,res){ 
//     database.query('SELECT * FROM `users`', function (err, rows, fields) {
//         if (err) throw err;
//         res.send({user : rows,
//         method: req.method});
//     })
// })
// .post(function (res, req) {

// })


// Start server
app.listen(3000, 'localhost', () => {
    console.log('Example app listening on port 3000!')
})

