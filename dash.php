<?php require_once './inc/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  <title>Document</title>
</head>

<style>
  @import url("https://fonts.googleapis.com/css2?family=Open+Sans&display=swap");

  :root {
    font-size: 16px;
    background-color: #e9e9e9;
    font-family: "Open Sans", sans-serif;
  }

  * {
    margin: 0;
    padding: 0;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }

  .navbar {
    z-index: 99;
    width: 13rem;
    height: 100vh;
    position: fixed;
    background: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    padding: 1rem 0;
  }


  .navbar .logo {
    text-align: center;
    margin-bottom: 2rem;
  }

  .navbar .logo img {
    width: 10rem;
  }

  .navbar .logo #logo-res {
    display: none;
  }

  .navbar .profile-image {
    text-align: center;
    margin-bottom: 2rem;
  }

  .navbar .profile-image> :first-child {
    width: 6rem;
    border-radius: 50px;
  }

  .navbar .profile-image> :nth-child(2) {
    font-size: 0.8rem;
  }

  .navbar .profile-image> :last-child {
    font-weight: bolder;
    font-size: 1.2rem;
  }

  .navbar .link-item {
    height: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
  }

  .navbar .link-item .link {
    height: 3rem;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    text-decoration: none;
    color: #1e1e1e;
  }

  .navbar .link-item .link img {
    width: 1.7rem;
    margin: 0 1.5rem;
  }

  .navbar .link-item .bottme-nav {
    margin-top: auto;
  }

  main {
    background-color: #e9e9e9;
    margin-left: 13rem;
    padding: 3rem;
    width: 100%;
    height: 100%;
    width: calc(100% - 13rem);
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
  }


  @media only screen and (max-width: 1000px) {
    main {
      width: 100%;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      margin-left: 4rem;
    }

    .navbar {
      height: 100%;
      width: 5rem;
    }

    .navbar .profile-image p {
      display: none;
    }

    .navbar .profile-image img {
      width: 3rem !important;
    }

    .link span {
      display: none;
    }

    .navbar .logo {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
    }

    .navbar .logo #logo-res {
      display: block;
      width: 3rem;
    }

    .navbar .logo #logo {
      display: none;
    }
  }




  .navbar {
    z-index: 99;
    width: 13rem;
    height: 100vh;
    position: fixed;
    background: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    padding: 1rem 0;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
  }

  @media screen and (max-width: 1000px) {
    .navbar {
      width: 60px;
      height: 100%;
    }
  }

  .navbar .logo {
    text-align: center;
    margin-bottom: 2rem;
  }

  .navbar .logo img {
    width: 10rem;
  }

  @media screen and (max-width: 1000px) {
    .navbar .logo {
      width: 100%;
    }

    .navbar .logo img {
      width: 90%;
      height: 100%;
    }
  }

  .navbar .mLogo {
    display: none;
  }

  @media screen and (max-width: 1000px) {
    .navbar .dlogo {
      display: none;
    }

    .navbar .mLogo {
      display: inline;
    }
  }

  .navbar .profile-image {
    text-align: center;
    margin-bottom: 2rem;
  }

  .navbar .profile-image> :first-child {
    width: 6rem;
    border-radius: 50px;
  }

  .navbar .profile-image> :nth-child(2) {
    font-size: 0.8rem;
  }

  .navbar .profile-image> :last-child {
    font-weight: bolder;
    font-size: 1.2rem;
  }

  @media screen and (max-width: 1000px) {
    .navbar .profile-image p {
      display: none;
    }

    .navbar .profile-image img {
      width: 40px;
      height: 40px;
    }
  }

  .navbar .link-item {
    height: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
  }

  .navbar .link-item .link {
    height: 3rem;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    text-decoration: none;
    color: #1e1e1e;
  }

  .navbar .link-item .link img {
    width: 1.7rem;
    margin: 0 1.5rem;
  }

  @media screen and (max-width: 1000px) {
    .navbar .link-item .link span {
      display: none;
    }

    .navbar .link-item .link img {
      width: 30px;
    }
  }
</style>

<body>


  <div class="navbar">
    <div class="logo dlogo">
      <a href="#" class=""><img src="icon/logo.svg" alt="logo smanager" /></a>
    </div>
    <div class="logo mLogo">
      <a href="#" class=""><img src="icon/logo-res.png" alt="logo smanager" /></a>
    </div>

    <div class="profile-image">
      <img id="profile" src="./uploads/<?= $profile_url ?>" alt="profile" />

      <p>Your Profile</p>
      <p class="user-name"><?= $name ?></p>
    </div>

    <div class="link-item">
      <a href="index.php" class="link">
        <img src="icon/icon-dash.svg" alt="icon" />
        <span>Dashboard</span>
      </a>
      <a href="add.php" class="link">
        <img src="icon/icon-add-product.svg" alt="icon" />
        <span>Add Items</span>
      </a>
      <a href="index.php" class="link">
        <img src="icon/icon-add-new-item.svg" alt="icon" />
        <span>Products</span>
      </a>
      <div class="bottme-nav">
        <a href="#" class="link">
          <img src="icon/icon-settings.svg" alt="icon" />
          <span>Settings</span>
        </a>
        <a class="link">
          <img src="icon/icon-logout.svg" alt="icon" />
          <span>Logout</span>
        </a>
      </div>
    </div>
  </div>


  <main>
    <h1 style="text-align: center;margin-bottom: 100px;">statistics of products</h1>
    <canvas id="myChart" height="100">
    </canvas>
  </main>
</body>
<script>
  let ctx = document.querySelector('#myChart');

  // let arr = ['a', 'a', 'a', 'b', 'c', 'c'];
  // let obj = {};
  // arr.forEach(_ => obj[_] = (obj[_] | 0) + 1);


  fetch('http://localhost/inventory/inc/createAt.php')
    .then(res => res.json())
    .then(data => {
      data = data.response;
      let arrd = [];
      let obj = {};
      for (const key of data) arrd.push(new Date(key['created_at']).toLocaleDateString());
      arrd.forEach(_ => obj[_] = (obj[_] | 0) + 1);
      charit(obj);

    })

  function charit(obj) {
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: Object.keys(obj),
        datasets: [{
          label: '# of Votes',
          data: Object.values(obj),
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 2
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 1
            }
          }]
        }
      }
    });
  }
</script>

</html>