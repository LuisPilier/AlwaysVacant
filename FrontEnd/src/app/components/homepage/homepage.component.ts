import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { ApisService } from 'src/app/services/apis.service';
import { LoginI } from 'src/app/models/login.interface';
import { RegisterI } from 'src/app/models/register.interface';
import { ResponseI } from 'src/app/models/response.interface';
import { Router } from '@angular/router';
@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.component.html',
  styleUrls: ['./homepage.component.css'],
  providers: [ApisService]
})
export class HomepageComponent implements OnInit {

  loginForm = new FormGroup({
    Usuario: new FormControl('', Validators.required),
    Contrasena: new FormControl('', Validators.required),
  });

  nuevoForm = new FormGroup({
    Nombre: new FormControl(''),
    Apellido: new FormControl(''),
    Usuario: new FormControl(''),
    Contrasena: new FormControl(''),
    ID_Rol: new FormControl(''),
    Correo: new FormControl('')
  });


  constructor(private api: ApisService) { }


  errorMessage: any = "";
  errorStatus: boolean = false;

  ngOnInit(): void {
    this.ValidarLocalStorage();
  }

  ValidarLocalStorage() {
    if (localStorage.getItem('Token')) {
      this.RedirigirPorTipoUsuario(localStorage.getItem('ID_Rol'));
    }
  }

  guardarLocalStorage(result: any) {
    sessionStorage.setItem('Usuario', JSON.stringify(result));
  }

  RedirigirPorTipoUsuario(id_rol: any) {
    console.log(id_rol)
    switch (id_rol) {
      case "1":
        document.location.href = (`http://localhost:4200/homepagejobs`);
        break;
      case "2":
        document.location.href = (`http://localhost:4200/homepagejobs`);
        break;
      case "3":
        document.location.href = (`http://localhost:4200/adminpage`);
        break;
    }
  }

  onlogin(form: LoginI) {
    this.api.loginByUser(form).subscribe(data => {
      let dataResponse: ResponseI = data;
      console.log(data);
      if (dataResponse.status == "ok") {
        localStorage.setItem("Token", dataResponse.result.Token);
        localStorage.setItem("ID_Rol", dataResponse.result.ID_Rol);
        localStorage.setItem("Usuario", dataResponse.result.Usuario);
        this.RedirigirPorTipoUsuario(localStorage.getItem('ID_Rol'));
      } else {
        this.errorStatus = true;
        this.errorMessage = dataResponse.result.error_msg;
      }
    })
  }

  postForm(form: RegisterI) {
    this.api.postUser(form).subscribe(data => {
      console.log(data);
      document.location.href = (`http://localhost:4200/homepage`);
    })
  }

}
