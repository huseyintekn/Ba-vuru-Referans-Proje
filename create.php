<?php $serverName = $_SERVER['SERVER_NAME']  ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-color: #8e8e8d47">
<div class="container mt-2" id="app">
    <div class="row p-5">
        <div class="card p-5">
            <div class="card-header">
                <div class="d-flex bd-highlight">
                    <div class="me-auto bd-highlight">
                        <h4>{{title}}</h4>
                    </div>
                </div>
            </div>
            <hr>
            <div class="" id="mess"></div>
            <div v-if="errors.length>0" class="alert alert-danger">
                <p>Lütfen form verilerini düzeltiniz.</p>
                <ul>
                    <li v-for="error in errors">{{error}}</li>
                </ul>
            </div>
            <div class="card-body">
                <form action="insert.php" method="post" novalidate="true">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  v-model="language" name="language" value="1" type="radio" id="language">
                                    <label class="form-check-label" for="inlineCheckbox1">Türkçe</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  v-model="language" name="language" value="0" type="radio" id="language">
                                    <label class="form-check-label" for="inlineCheckbox2">İngilizce</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Ad</label>
                                <input type="text" v-model="name" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="surname" class="form-label">Soyad</label>
                                <input type="text"  v-model="surname" class="form-control" id="surname" name="surname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input name="phone" v-model="phone" type="number" min="0" class="form-control" id="phone" aria-describedby="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email"  v-model="email" name="email" class="form-control" id="email" aria-describedby="email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="message" class="form-label">Mesaj</label>
                                <textarea name="message" v-model="message" class="form-control" id="message" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" @click="saveButton">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="assets/js/jquery/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/vue@next"></script>
<script>

    const app = Vue.createApp({
        data(){
            return {
                title: "Başvuru Referans Ekle",
                name: '',
                surname: '',
                phone: '',
                email: '',
                message: '',
                language: '',
                errors: [],
                succ:false,
                err:false,
                mess:''
            };
        },
        methods : {
            saveButton(e){
                e.preventDefault();
                this.errors = [];
                if (!this.name) this.errors.push('Ad alanı gereklidir.');
                if (!this.surname) this.errors.push('Soyad alanı gereklidir.');
                if (!this.phone) this.errors.push('Telefon alanı gereklidir.');
                if (!this.email) this.errors.push('E-posta alanı gereklidir.');
                if (!this.message) this.errors.push('Mesaj alanı gereklidir.');
                if (!this.language) this.errors.push('Dil alanı gereklidir.');
                if (this.errors.length === 0){
                    $(document).ready(function (){
                        var name = $('#name').val();
                        var surname = $('#surname').val();
                        var phone = $('#phone').val();
                        var email = $('#email').val();
                        var message = $('#message').val();
                        var language = $('#language').val();
                        $.ajax({
                            type:'POST',
                            url:'insert.php',
                            data:{'name':name, 'surname':surname, 'phone':phone, 'email':email, 'message':message, 'language':language},
                            success:function (res){
                                if (res = "success"){
                                    html ='';
                                    html +='<div v-if="succ" class="alert alert-success">'
                                    html +='<p>İşlem Başarılı</p>'
                                    html +='</div>';
                                    $('#mess').append(html);
                                }else if(res = "error"){
                                    html ='';
                                    html +='<div v-if="succ" class="alert alert-danger">'
                                    html +='<p>İşlem Başarısız</p>'
                                    html +='</div>';
                                    $('#mess').append(html);
                                }
                            }
                        });
                    });
                }
            }
        }

    }).mount('#app');
</script>
</body>
</html>

