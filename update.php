<?php require_once './inc/auth.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/update.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <title>smanger</title>
</head>
<style>

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
      <a href="dash.php" class="link">
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
    <h1>Update Item</h1>

    <div class="inp">
      <label for="item_name">Item name</label>
      <input id="item_name" type="text">
    </div>
    <div class="inp">
      <label for="desc">Item description</label>
      <textarea id="desc" cols="30" rows="10"></textarea>
    </div>

    <div class="drop-zone">
      <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43">
        <path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z">
        </path>
      </svg>
      <span><strong>Choose a file</strong> or drag it here</span>
      <img id="preview" src="#" alt="preview">
    </div>

    <div class="inp">
      <label for="price">Price</label>
      <input id="price" type="text">
    </div>

    <div class="inp">
      <label for="quantity">Quantity</label>
      <input id="quantity" type="text">
    </div>

    <div class="actions">
      <button id="cancel">Cancel</button>
      <button id="submit">Update</button>
    </div>
  </main>
</body>
<script>
  let preview = document.querySelector('#preview');
  let drop_zone = document.querySelector('.drop-zone');

  let cancel = document.querySelector('#cancel');
  let submit = document.querySelector('#submit');

  let priceInput = document.querySelector('#price');
  let quantityInput = document.querySelector('#quantity');
  let descInput = document.querySelector('#desc');
  let nameInput = document.querySelector('#item_name');

  let user_name = document.querySelector("#user-name");

  let idLocalStorage = localStorage.getItem('idp') || null;

  cancel.addEventListener('click', () => {
    location.href = 'http://127.0.0.1:5500/index.html';
  });

  let postData = async (url, data) => {
    let response = await fetch(url, {
      method: 'POST',
      body: data
    });
    let result = await response.json();
    if (result.response == true) {
      msg('success', 'product successfully added');
    } else {
      msg('error', 'something went wrong');
    }
  }

  drop_zone.addEventListener('dragover', _ => {
    if (inputFile.files.length > 0) preview.style.filter = 'blur(3px)';
    drop_zone.classList.add('drop-zone-file_dragover');
  });
  drop_zone.addEventListener('dragleave', _ => {
    if (inputFile.files.length > 0) preview.style.filter = 'blur(0)';
    drop_zone.classList.remove('drop-zone-file_dragover');
  });

  submit.addEventListener('click', _ => {

    if (!/^[\w\s]+$/.test(item_name.value) || !/^[\w\s]+$/.test(desc.value)) {
      msg('error', 'Enter valid name and desc');
      return;
    }

    if (isNaN(price.value) || isNaN(quantity.value)) {
      msg('error', 'Enter valid price and quantity');
      return;
    }

    let fd = new FormData();
    fd.append('name', item_name.value);
    fd.append('desc', desc.value);
    fd.append('price', price.value);
    fd.append('quantity', quantity.value);
    fd.append('id', idLocalStorage);

    postData('http://localhost/inventory/inc/update.php', fd);

  });

  let getProduct = async (id) => {
    if (id == null) return null;
    let fd = new FormData();
    fd.append('id', id);

    let config = {
      method: 'POST',
      body: fd
    };
    let response = await fetch('http://localhost/inventory/inc/one_product.php', config);
    let data = await response.json();

    return data.response;
  }


  getProduct(idLocalStorage).then(data => {
    if (data == null) return;
    const {
      id,
      description,
      employee_id,
      name,
      price,
      product_img_url,
      quantity
    } = data;

    preview.src = `http://localhost/inventory/uploads/${product_img_url}`;
    preview.style.visibility = 'visible';

    priceInput.value = price;
    quantityInput.value = quantity;
    descInput.value = description;
    nameInput.value = name;

  });

  function msg(_icon, _title) {
    Swal.fire({
      position: 'top-end',
      icon: _icon,
      title: _title,
      showConfirmButton: false,
      timer: 2000
    });
  }

  document.querySelector("body > div > div.link-item > div > a:nth-child(2) > img").addEventListener('click', () => {
    let fd = new FormData();
    fd.append('logout', true);
    fetch('http://localhost/inventory/inc/logout.php', {
        method: 'POST',
        body: fd
      })
      .then(res => res.json())
      .then(data => location.href = 'http://localhost/inventory/login');
  });
</script>

</html>

