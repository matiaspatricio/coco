const { verifySignUp } = require("../middlewares");
const controller = require("../controllers/publicaciones.controller");
const express = require("express");
const router = express.Router();






module.exports = function(app) {
  app.use(function(req, res, next) {
    res.header(
      "Access-Control-Allow-Headers",
      "Origin, Content-Type, Accept"
    );
    next();
  });

  app.post(
    "/publicacion",
    [
      verifySignUp.checkDuplicateUsernameOrEmail,
      verifySignUp.checkRolesExisted
    ],
    controller.crearPublicacion
  );
};
