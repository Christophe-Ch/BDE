const express = require('express');
const router = express.Router();
const mysql = require('mysql'); // MySQL module
const Joi = require('joi'); // Input validation module
const bcrypt = require('bcryptjs'); // Encryption module

// Database connection
const database = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: "bde"
});

const laravel = 'http://127.0.0.1:8000/';


router.post('/inscription', async (req, res) => {
    // Validation schema
    let schema = {
        name: Joi.string().required(),
        email: Joi.string().email().required(),
        password: Joi.string().regex(/.*[0-9]+.*/).regex(/.*[A-Z]+.*/).required(),
        password_confirmation: Joi.string().required().valid(Joi.ref('password')),
        centre_id: Joi.number().integer().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Send request to Laravel
        request.put(
            laravel + 'api/register', // route
            { json: req.body }, // request body
            function (error, response, body) {
                res.status(response.statusCode);
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
        res.status(400);
        return res.send({
            registered: false,
            message: validate.error
        });
    }
});

router.post('/connection', (req, res) => {
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
                        res.status(400);
                        return res.send({
                            connected: false,
                            token: null
                        });
                    }
                });
            }
            else { // Wrong email
                res.status(400);
                return res.send({
                    connected: false,
                    message: validate.error
                });
            }
        });
    }
    else {
        res.status(400);
        return res.send({
            connected: 'false',
            token: null
        });
    }
});

module.exports = router;