// Modules
const express = require('express');
const router = express.Router();
const mysql = require('mysql'); // MySQL module
const Joi = require('joi'); // Input validation module
const request = require('request'); // Request module

// Database connection
const database = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: "bde"
});

const laravel = 'http://127.0.0.1:8000/';

router.get('/', (req, res) => {
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
                if (results[0].statut_id == 2) { // If user has BDE status
                    sql = "SELECT * FROM users";

                    database.query(sql, (error, results, fields) => { // Get all users
                        if (error) throw error;


                        return res.send({
                            users: results
                        });
                    });
                }
                else {
                    res.status(400);
                    return res.send({
                        users: null,
                        message: "Not authorized"
                    });
                }
            }
            else {
                return res.send({
                    users: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else { // Wrong token
        return res.send({
            users: null,
            message: validate.error
        });
    }
});

router.get('/:id', (req, res) => {
    // Validation schemas
    let bodySchema = {
        token: Joi.string().required()
    };

    let paramsSchema = {
        id: Joi.number().integer().required()
    };

    let validateBody = Joi.validate(req.body, bodySchema);
    let validateParams = Joi.validate(req.params, paramsSchema);

    if (!validateBody.error && !validateParams.error) {
        // Get token
        let api_token = req.body.token;
        let id = req.params.id;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                if (results[0].statut_id == 2) { // If user has BDE status
                    sql = "SELECT * FROM users WHERE id = " + database.escape(id);

                    database.query(sql, (error, results, fields) => { // Get all users
                        if (error) throw error;

                        if (results && results.length) {

                            return res.send({
                                user: results[0]
                            });
                        }
                        else {
                            res.status(404);
                            return res.send({
                                users: null,
                                message: "User not found"
                            });
                        }
                    });
                }
                else {
                    res.status(400);
                    return res.send({
                        users: null,
                        message: "Not authorized"
                    });
                }
            }
            else {
                res.status(400);
                return res.send({
                    users: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else { // Wrong token or id
        res.status(400);
        return res.send({
            users: null,
            bodyMessage: validateBody.error,
            paramsMessage: validateParams.error
        });
    }
});

router.put('/:id', (req, res) => {
    // Validation schemas
    let bodySchema = {
        token: Joi.string().required(),
        last_name: Joi.string(),
        first_name: Joi.string(),
        email: Joi.string().email(),
        password: Joi.string().regex(/.*[0-9]+.*/).regex(/.*[A-Z]+.*/),
        password_confirmation: Joi.string().valid(Joi.ref('password')),
    };

    let paramsSchema = {
        id: Joi.number().integer().required()
    };

    let validateBody = Joi.validate(req.body, bodySchema);
    let validateParams = Joi.validate(req.params, paramsSchema);

    if (!validateBody.error && !validateParams.error) {
        // Get token
        let api_token = req.body.token;
        let id = req.params.id;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                if (results[0].statut_id == 2) { // If user has BDE status
                    request.put(
                        laravel + 'api/users/' + id, // route
                        { json: req.body }, // request body
                        function (error, response, body) {
                            res.status(response.statusCode);
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
                    res.status(400);
                    return res.send({
                        users: null,
                        message: "Not authorized"
                    });
                }
            }
            else {
                res.status(400);
                return res.send({
                    users: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else { // Wrong token or id
        res.status(400);
        return res.send({
            users: null,
            bodyMessage: validateBody.error,
            paramsMessage: validateParams.error
        });
    }
});

router.delete('/:id', (req, res) => {
    // Validation schemas
    let bodySchema = {
        token: Joi.string().required()
    };

    let paramsSchema = {
        id: Joi.number().integer().required()
    };

    let validateBody = Joi.validate(req.body, bodySchema);
    let validateParams = Joi.validate(req.params, paramsSchema);

    if (!validateBody.error && !validateParams.error) {
        // Get token
        let api_token = req.body.token;
        let id = req.params.id;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                if (results[0].statut_id == 2) { // If user has BDE status
                    sql = "DELETE FROM users WHERE id = " + database.escape(id);

                    database.query(sql, (error, results, fields) => { // Get all users
                        if (error) throw error;


                        return res.send({
                            message: "User deleted"
                        });
                    });
                }
                else {
                    res.status(400);
                    return res.send({
                        users: null,
                        message: "Not authorized"
                    });
                }
            }
            else {
                res.status(400);
                return res.send({
                    users: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else { // Wrong token or id
        return res.send({
            users: null,
            bodyMessage: validateBody.error,
            paramsMessage: validateParams.error
        });
    }
});

module.exports = router;