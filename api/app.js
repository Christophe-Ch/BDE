const bcrypt = require('bcryptjs'); // Encryption module
const express = require('express'); // Server module
const mysql = require('mysql'); // MySQL module
const Joi = require('joi'); // Input validation module
const request = require('request'); // Request module

const laravel = 'http://127.0.0.1:8000/';

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
app.post('/api/inscription', async (req, res) => {
    // Validation schema
    let schema = {
        name: Joi.string().required(),
        email: Joi.string().email().required(),
        password: Joi.string().regex(/.*[0-9]+.*/).regex(/.*[A-Z]+.*/).required(),
        password_confirmation: Joi.string().required().valid(Joi.ref('password')),
        centre_id: Joi.number().integer().required()
    };

    let validate = Joi.validate(req.body, schema);

    return res.send(validate);

    if (!validate.error) {
        // Send request to Laravel
        request.post(
            laravel + 'api/register', // route
            { json: req.body }, // request body
            function (error, response, body) {
                if (!error && response.statusCode == 201) { // if request succeed
                    delete body.id;
                    return res.send({
                        registered: true,
                        user: body
                    });
                }
                else {
                    return res.send({
                        registered: false,
                        message: body
                    });
                }
            }
        );
    }
    else {
        return res.send({
            registered: false,
            message: validate.error
        });
    }
});

app.post('/api/connection', (req, res) => {
    // Validation schema
    let schema = {
        email: Joi.string().email().required(),
        password: Joi.string().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Get credentials
        let email = req.body.email;
        let password = req.body.password;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE email = ' + database.escape(email);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                // Hash and compare passwords
                bcrypt.compare(password, results[0].password, (err, result) => {
                    if (result) { // Passwords match
                        return res.send({
                            connected: true,
                            token: results[0].api_token
                        });
                    }
                    else {
                        return res.send({
                            connected: false,
                            token: null
                        });
                    }
                });
            }
            else { // Wrong email
                return res.send({
                    connected: false,
                    message: validate.error
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

// Profile
app.get('/api/profile', (req, res) => {
    // Validation schema
    let schema = {
        token: Joi.string().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Get token
        let api_token = req.body.token;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                delete results[0].id;
                delete results[0].password;
                return res.send({
                    user: results[0]
                });
            }
            else { // Wrong token
                return res.send({
                    user: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else {
        return res.send({
            user: null,
            message: validate.error
        });
    }
});

app.post('/api/profile', (req, res) => {
    // Validation schema
    let schema = {
        token: Joi.string().required(),
        last_name: Joi.string(),
        first_name: Joi.string(),
        email: Joi.string().email()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Send request to Laravel
        request.post(
            laravel + 'api/profile', // route
            { json: req.body }, // request body
            function (error, response, body) {
                if (!error && response.statusCode == 200) { // if request succeed
                    delete body.id;
                    return res.send({
                        result: true,
                        user: body
                    });
                }
                else {
                    return res.send({
                        result: false,
                        message: body
                    });
                }
            }
        );
    }
    else {
        return res.send({
            result: false,
            message: validate.error
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
    console.log('API listening on port 3000')
})

