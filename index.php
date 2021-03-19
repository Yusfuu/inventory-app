<?php require_once './inc/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <link rel="stylesheet" href="css/index.css" />
  <title>smanger</title>
</head>
<style>
  .profileimg {
    width: 6rem;
    height: 6rem;
    border-radius: 50%;
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
      <img id="profile" class="profileimg" src="./uploads/<?= $profile_url ?>" alt="profile" />
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
        <a href="#" id="logout" class="link">
          <img src="icon/icon-logout.svg" alt="icon" />
          <span>Logout</span>
        </a>
      </div>
    </div>
  </div>

  <main>
    <h1>Available Products</h1>
    <div class="tableHolder">
      <table id="table">
        <tr id="row">
          <th>Product</th>
          <th>Name</th>
          <th>Price</th>
          <th>Amount</th>
          <th>Add date</th>
          <th>Action</th>
        </tr>
      </table>
    </div>
  </main>
</body>
<script>
  let getProducts = async () => {
    let response = await fetch('http://localhost/inventory/inc/products.php');
    let data = await response.json();
    return data.response;
  }

  let removeProduct = async (id, file) => {
    let fd = new FormData();
    fd.append('id', id);
    fd.append('file', file);
    let config = {
      method: 'POST',
      body: fd
    }
    let response = await fetch('http://localhost/inventory/inc/delete.php', config);
    let data = await response.json();
    return data.response;
  }


  let render = (data) => {
    const {
      id,
      description,
      name,
      price,
      product_img_url,
      quantity,
      created_at
    } = data;

    let created = new Date(created_at).toLocaleDateString();
    return `<tr data-id="${id}" data-desc="${description}">
          <td>
            <div class="product">
              <img id="pimg" src="http://localhost/inventory/uploads/${product_img_url}" alt="Product" />
            </div>
          </td>
          <td>${name}</td>
          <td>${price}$</td>
          <td>${quantity}</td>
          <td>${created}</td>
          <td>
            <div class="action">
              <img src="icon/icon-delete.svg" id="delete" alt="delete" />
              <img src="icon/icon-edit.svg" id="edit" alt="edit" />
            </div>
          </td>
        </tr>`;
  }

  let row = document.querySelector("#row");
  getProducts()
    .then(result => {
      for (let key in result) {
        let html = render(result[key]);
        row.insertAdjacentHTML('afterend', html);
      }

      [...document.querySelectorAll('#delete')].forEach(tr => {
        tr.addEventListener('click', () => {

          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              let row = tr.parentNode.parentNode.parentNode;
              let fileDeleted = row.firstElementChild.firstElementChild.firstElementChild.src.split('/').reverse()[0]

              let id = row.getAttribute('data-id');

              removeProduct(id, fileDeleted)
                .then(_ => {
                  Swal.fire(
                    'Deleted!',
                    'Product has been deleted.',
                    'success'
                  );
                  row.remove();
                });
            }
          })

        })
      });

      [...document.querySelectorAll('#edit')].forEach(tr => {
        tr.addEventListener('click', () => {

          let row = tr.parentNode.parentNode.parentNode;

          Swal.fire({
            title: 'do you want to update product',
            icon: 'question',
            iconHtml: '?',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showCancelButton: true,
            showCloseButton: true
          }).then((result) => {
            if (result.isConfirmed) {
              let id = row.getAttribute('data-id');
              localStorage.setItem('idp', id);
              location.href = 'http://localhost/inventory/update.php';
            }
          });

        })
      });

      [...document.querySelectorAll('#pimg')].forEach(pi => {
        pi.addEventListener('click', () => {

          let parent = pi.parentElement.parentElement.parentElement;
          Swal.fire({
            title: parent.children[1].textContent,
            text: parent.getAttribute('data-desc'),
            imageUrl: pi.src,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
          });


        })
      });


    });

  document.querySelector("#logout").addEventListener('click', () => {
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