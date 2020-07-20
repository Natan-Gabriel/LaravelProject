
@extends('layouts.app')


@section('content')

<div id="contact" class="container">

  <h3 class="text-center">Contact</h3>
  <p class="text-center"><em>We want to know your needs</em></p>

  <div class="row">
    <!-- <style scoped>
      @import "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css";
    </style> -->
    <div class="col-md-4">
      <p><i>Do you have a question or do you want do get an offer?Send us a message</i></p>
      <p><span class="glyphicon glyphicon-envelope"></span><b>Location</b>:Wall Street,NY 098902, US</b></p>
      <p><span class="glyphicon glyphicon-phone"></span><b>Phone</b>: +00 747385206</p>
      <p><span class="glyphicon glyphicon-envelope"></span><b>Email</b>: questions@flightstats.com</p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
      <br>


      <div class="row">
        <div class="col-md-12 form-group">
          <button  onclick="myFunction()"class="btn btn-success" type="submit">Send</button>
        </div>
      </div>
    </div>

  </div>

  <script type="text/javascript">

var nodemailer = require('nodemailer');
   function myFunction() {
    
    
    

// var transporter = nodemailer.createTransport({
//   service: 'gmail',
//   auth: {
//     user: '1natangabriel99@gmail.com',
//     pass: ''
//   }
// });

// var mailOptions = {
//   from: '1natangabriel99@gmail.com',
//   to: 'natangabriel99@yahoo.com',
//   subject: 'Sending Email using Node.js',
//   text: 'That was easy!'
// };

// transporter.sendMail(mailOptions, function(error, info){
//   if (error) {
//     console.log(error);
//   } else {
//     console.log('Email sent: ' + info.response);
//   }
// });
    
  alert("We will come back with a response as soon as possible");
}</script>

  @endsection