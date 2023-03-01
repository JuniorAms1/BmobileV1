<?php
session_start();
include '../../connexion.php'; ?>
<html>
  <head>
      <meta charset="utf-8">
    <title>Instascan &ndash; Demo</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  </head>
  <body>
    <!-- <a href="../../scan.php"><img style="position: absolute; top: 0; right: 0; border: 0; z-index: 1" src="https://camo.githubusercontent.com/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png"></a> -->

    <div id="app">
      <div class="sidebar">
        <section class="cameras">
          <h2>Cameras</h2>
          <ul>
            <li v-if="cameras.length === 0" class="empty">No cameras found</li>
            <li v-for="camera in cameras">
              <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active">{{ formatName(camera.name) }}</span>
              <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
                <a @click.stop="selectCamera(camera)">{{ formatName(camera.name) }}</a>
              </span>
            </li>
          </ul>
        </section>
        <section class="scans">
          <h2>Scans</h2>
          <ul v-if="scans.length === 0">
            <li class="empty">No scans yet</li>
          </ul>
           <transition-group name="scans" tag="ul">
            <li v-for="scan in scans" :key="scan.date" :title="scan.content">{{scan.content}}

          <form method="POST" action="" class="form-group">
           <input type="hidden" name="membre" :key="scan.date" :value="scan.content" >
           <label for="name">Montant
             <input type="text" name="montant" class="form-control">
           </label>
           <br>

              <input type="submit" name="valider" class="form-control">
          </form>

            </li>

          </transition-group>
        </section>
        <center>
          <button type="button" name="button"><a href="../../partenaire/accueilGerant.php">Retour</a></button>
        </center>



      </div>
      <div class="preview-container">
        <video id="preview"></video>
      </div>
    </div>
    <script type="text/javascript">
      var app = new Vue({
  el: '#app',
  data: {
    scanner: null,
    activeCameraId: null,
    cameras: [],
    scans: []
  },
  mounted: function () {
    var self = this;
    self.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
    self.scanner.addListener('scan', function (content, image) {
      self.scans.unshift({ date: +(Date.now()), content: content });
      var audio =new Audio("Prize.wav");
      audio.play();

    });
    Instascan.Camera.getCameras().then(function (cameras) {
      self.cameras = cameras;
      if (cameras.length > 0) {
        self.activeCameraId = cameras[0].id;
        self.scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
  },
  methods: {
    formatName: function (name) {
      return name || '(unknown)';
    },
    selectCamera: function (camera) {
      this.activeCameraId = camera.id;
      this.scanner.start(camera);
    }
  }
});
    </script>
  </body>
</html>

<?php

  if (isset($_POST['valider'])) {
      extract($_POST);
      $rqt=$connect->query("SELECT * FROM carte where numCarte='$membre'");
      $result=$rqt->rowCount();
      if ($result==1) {
        $mb=$rqt->fetch();

        $rqt2=$connect->prepare("INSERT INTO frequentation (idMb,idStruct,dateFreq,montant) values(?,?,NOW(),?)");
        $rqt2->execute(array($mb['idMb'],$_SESSION['idStruct'],$montant));
      }
      else{
          echo'<script>
    alert("mauvaise carte");
  </script>';
      }
  }
 ?>
