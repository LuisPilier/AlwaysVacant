import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ApisService } from 'src/app/services/apis.service';
import {Router} from '@angular/router'
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-editjob',
  templateUrl: './editjob.component.html',
  styleUrls: ['./editjob.component.css']
})
export class EditjobComponent implements OnInit {

  editarForm = new FormGroup({
    Nombre: new FormControl(''),
    ID_Vacante: new FormControl(''),
    Token: new FormControl('')
  });




  constructor(private http: HttpClient, private router: Router) { }
  conversion: [] = [];
  paginactual: number = 1;


  ngOnInit(): void {
    if (localStorage.getItem('ID_Rol') != '3') {
      this.RedirigirPorTipoUsuario(localStorage.getItem('ID_Rol'));
    }else{
      this.getData();
    }
  }
  getData(){
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/vacante.php')
    .subscribe((data:any) => {
     this.conversion=data;
     console.log( this.conversion );
    });
  }

  editarvacante(ID_Vacante: any){
    this.router.navigate(['editvacant',ID_Vacante]);
  }
  RedirigirPorTipoUsuario(id_rol: any) {
    console.log(id_rol)
    switch (id_rol) {
      case "1":
        document.location.href = (`https://alwaysvacant.netlify.app/homepagejobs`);
        break;
      case "2":
        document.location.href = (`https://alwaysvacant.netlify.app/homepagejobs`);
        break;
      case "3":
        document.location.href = (`https://alwaysvacant.netlify.app/adminpage`);
        break;
      default:
        document.location.href = (`https://alwaysvacant.netlify.app/homepage`);
    }
  }


}
