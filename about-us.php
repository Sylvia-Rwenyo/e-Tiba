<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>About CERA</title>
</head>
<body class="home">
  <?php include_once "menu.php" ?>
  <div class="intro">
      <div class="c-phrase-section">
          <div class="c-phrase">
              <h3>Cancer care made seamless,&nbsp;<b>for you</b></h3>
          </div>
          <p>Let us help you track your health and treatment process</p>
      </div>
      <div class="banner">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <!-- <div class="carousel-item active">
              <img src="images/" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Connect directly to your doctor</h5>
                <p>Call and direct messaging enabled</p>
              </div>
            </div> -->
            <div class="carousel-item active">
              <img src="images/vitals.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block" id="carousel1">
                <h5 class="top-text">Track your health status</h5>
                <p class="top-text">Log in how you feel at any time</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="images/pills.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block" id="carousel2">
                <h5 class="top-text">Be on top of your medication intake</h5>
                <p class="top-text">Reminders are autoscheduled for you</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
  </div>
  <a href="#video-description"><button onclick = "openVideo();" id = "buttonStyleVideo">Open Video</button></a>
  <a href="#transcript"><button onclick = "openTranscript();" id = "buttonStyleTranscript">Read Transcript</button><br/></a>
  <div id="video-description" style="position:relative">
      <video width="550" height="400" style="border:1px 1px 1px" controls>
          <source src="img/CERA.mp4" type="video/mp4"/>
          Your browser does not support video tag
      </video><br/>
      <a href="#activities"><button type = "button" class="btn-cancel" onclick="closeVideo();">Close Video</button></a>
  </div>
  <div id="transcript" style="position:relative">
      <div>
          <button type = "button" class="btn-cancel-trasncript" width="20px" onclick="closeTranscript();"><strong>X</strong></button>
          <p><strong>Cera</strong>, an all encompassing app for full cancer care. It will enable oncologists and healthcare 
            providers to work together with the patient to coordinate their care and ensure they receive the appropriate 
            treatment in the comfort of their homes. The app ensures remote access to oncologists ,monitoring of treatment,
            adherence to medication, early detection of side effects and treatment failure ,offers education on their 
            conditions and preserves the patient’s mental health.
            This mobile and web application that will be installed in healthcare facilities as well as the patient’s phone 
            to facilitate connection between cancer patients and cancer specialists.</p>
          <h2>Through Cera</h2>
          <ul>
            <li>
              The oncologists can set up appointments with the patients where treatment is prescribed. The patient will receive reminders for follow-up.
            </li>   
            <li>
              The patient can view nearby cancer care centres offering treatment where their vitals and test results during chemo can be uploaded.
            </li>
          </ul>
          <h4>ELECTRONIC HEALTH RECORDS</h4> 
          The patient’s information such as test results and history are uploaded and made available to the oncologist. 
          <h4>TELEMEDICINE</h4>
          The oncologists can set up appointments with the patients. Patients can communicate with healthcare providers remotely through secure video calls or messaging. This would enable patients to receive timely care and support without the need to travel to a healthcare facility
          <h4>PATIENT DIARY</h4> 
          The patient can log in their medication intake, symptoms, and how they feel daily. The patient receives reminders to take their medication and fill in their daily logs. 
          <h4>REMOTE MONITORING</h4> 
          The patient’s symptoms and response to treatment is monitored through their daily logs. The app intelligently tracks the patient's symptoms and automatically alerts the doctor of any red flags so that timely intervention can take place.
          <h4>TELE COUNSELLING</h4> 
          The patient is able to set up meetings with a therapist or a counsellor to improve their mental health. In addition, they can be connected to nearby cancer patients to form support groups.
          <ul>
              <li>One on one counselling sessions with therapist</li>
              <li>Group sessions with therapist and other cancer patients</li>
          </ul>
          -Data from the app can be used to add to help in medical research and inform policies concerning cancer patients.
      </div>
      <a href="#activities"><button type = "button" class="btn-cancel" onclick="closeTranscript();">Close Transcript</button></a>
  </div>
  <script type="text/javascript">
    function openVideo()
    {
      document.getElementById("video-description").style.display="block";
        document.getElementById("transcript").style.display="none";
    }
    function closeVideo()
    {
      document.getElementById("video-description").style.display="none";
    }
    function openTranscript()
    {
      document.getElementById("transcript").style.display="block";
        document.getElementById("video-description").style.display="none";
    }
    function closeTranscript()
    {
      document.getElementById("transcript").style.display="none";
    }
  </script>
</body>
</html>