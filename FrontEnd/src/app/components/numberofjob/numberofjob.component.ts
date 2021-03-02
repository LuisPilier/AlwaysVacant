import { Component, OnInit } from '@angular/core';
import { VacantadminI } from 'src/app/models/vacanteadmin.interface';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { ApisService } from 'src/app/services/apis.service';


@Component({
  selector: 'app-numberofjob',
  templateUrl: './numberofjob.component.html',
  styleUrls: ['./numberofjob.component.css']
})
export class NumberofjobComponent implements OnInit {

  editarForm = new FormGroup({
    Token: new FormControl(''),
    Numero_vacantes: new FormControl(''),
  })
  constructor(private api: ApisService) { }

  ngOnInit(): void {
    if (localStorage.getItem('ID_Rol') != '3') {
      this.RedirigirPorTipoUsuario(localStorage.getItem('ID_Rol'));
    } else {
      let Token = localStorage.getItem('Token');
      this.editarForm.patchValue({
        'Token': Token
      });
    }
  }
  putForm(form: VacantadminI) {
    this.api.putVacantAdmin(form).subscribe(data => {
      console.log(data);
      document.location.href = (`http://localhost:4200/numberofjobs`);
    })
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
      default:
        document.location.href = (`http://localhost:4200/homepage`);
    }
  }


}
