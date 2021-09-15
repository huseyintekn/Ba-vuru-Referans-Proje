<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-color: #8e8e8d47">
<div class="container mt-2" id="app">
    <router-view></router-view>
    <div class="row p-5">
        <div class="card p-5">
            <div class="card-header">
                <div class="d-flex bd-highlight">
                    <div class="me-auto bd-highlight">
                        <h4>{{title}}</h4>
                    </div>
                    <div class="bd-highlight">
                        <a class="btn btn-primary" href="create.php">EKLE</a>
                    </div>
                </div>
            </div>
            <hr>
            <?php if (isset($_GET['process'])){ ?>
                <div class="col-md-12">
                    <div class="alert <?php if ($_GET['process'] == 'success'){ echo 'alert-success'; } elseif($_GET['process'] == 'error'){ echo 'alert-danger'; } ?>">
                        <p><?php if ($_GET['process'] == 'success'){ echo 'işlem başarılı'; } elseif($_GET['process'] == 'error'){ echo 'işlem başarısız'; } ?></p>
                    </div>
                </div>
           <?php } ?>
            <div class="card-body">

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ad Soyad</th>
                            <th scope="col">Telefon</th>
                            <th scope="col">E-posta</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="list in  lists">
                            <th scope="row">{{list.id}}</th>
                            <td>{{list.name}} {{list.surname}}</td>
                            <td>{{list.phone}}</td>
                            <td>{{list.email}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/vue@next"></script>
<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/vue.js"></script>
<script src="assets/js/vue-router.js"></script>
<script>
    const page_create = {
        template: '<h1>EKLE</h1>'
    }
    const page_list = {
        template: ''
    }
    const routes = [
        {path: '/list', component: page_list},
        {path: '/create', component: page_create}
    ];

    const router = new VueRouter({
        routes,
        mode: 'history'
    });

    const app = new Vue({
        router: router,
        el: '#app',
        name: 'Developer',
        data:{
            title: "Başvuru Referans Verileri",
            saveLink: "test",
            lists: []
        },
        created(){
            fetch('http://tremglobal.test/select.php')
            .then((res) => {
                return res.json();
            })
            .then((res) => {
                this.lists = res
            })
        }
    });
</script>
</body>
</html>
