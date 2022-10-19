var express = require('express');
var user_dao = require('sport-track-db').user_dao;
var router = express.Router();

router.get('/', async function(req, res, next) {

  var user = await user_dao.findByKey(req.session.userID);

  var lname = user.lname;
  var fname = user.fname;
  var birthdate = user.birthdate;
  var sex = user.sex;
  var height = user.height;
  var weight = user.weight;
  var email = req.session.userID;

  res.render('user_update_form', {'lname': lname, 'fname': fname, 'birthdate': birthdate, 'sex': sex, 'height': height, 'weight': weight, 'email': email});
});

router.post('/', async function (req, res, next) {
  
  var user = await user_dao.findByKey(req.session.userID);

  var lname = user.lname;
  var fname = user.fname;
  var birthdate = user.birthdate;
  var sex = user.sex;
  var height = user.height;
  var weight = user.weight;

  console.log([lname, fname, birthdate, sex, height, weight], req.session.userID)
  await user_dao.update([lname, fname, birthdate, sex, height, weight], req.session.userID);
  
  res.render("user_update_form", {'lname': lname, 'fname': fname, 'birthdate': birthdate, 'sex': sex, 'height': height, 'weight': weight, 'isUpdated': true});
});

module.exports = router;
