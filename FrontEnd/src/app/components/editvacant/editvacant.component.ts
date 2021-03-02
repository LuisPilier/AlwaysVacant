import { Component, OnInit } from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {VacantesI} from 'src/app/models/vacantes.interface';
import {ApisService} from 'src/app/services/apis.service';
import {FormGroup, FormControl, Validators} from '@angular/forms';
import { HttpClient } from '@angular/common/http';


@Component({
  selector: 'app-editvacant',
  templateUrl: './editvacant.component.html',
  styleUrls: ['./editvacant.component.css']
})
export class EditvacantComponent implements OnInit {

  constructor(private activerouter: ActivatedRoute, private router: Router, private api: ApisService, private http: HttpClient) { }
  Ciudad: [] = [];
  //@ts-ignore
 datosVacante!: VacantesI;
 editarForm = new FormGroup({
  Token: new FormControl(''),
  Compania: new FormControl(''),
  ID_Tipo_Vacante: new FormControl(''),
  Posicion: new FormControl(''),
  ID_Ciudad: new FormControl(''),
  Ubicacion: new FormControl(''),
  ID_Categoria: new FormControl(''),
  URL: new  FormControl(''),
  Descripcion: new FormControl(''),
  Logo: new FormControl(''),
  Email: new FormControl(''),
  Nombre: new FormControl(''),
  ID_Vacante: new FormControl('')
 })

  ngOnInit(): void {
    
    let ID_Vacante = this.activerouter.snapshot.paramMap.get('ID_Vacante');
    let Token = this.getToken();
    this.api.getUnicaVacante(ID_Vacante).subscribe(data =>{
      
    //@ts-ignore
      this.datosVacante = data[0];
      this.editarForm.setValue({
        'Token': Token,
        'Compania':this.datosVacante.Compania,
        'ID_Tipo_Vacante':this.datosVacante.ID_Tipo_Vacante,
        'Posicion':this.datosVacante.Posicion,
        'ID_Ciudad':this.datosVacante.ID_Ciudad,
        'Ubicacion':this.datosVacante.Ubicacion,
        'ID_Categoria':this.datosVacante.ID_Categoria,
        'URL':this.datosVacante.URL,
        'ID_Vacante': ID_Vacante,
        'Descripcion':this.datosVacante.Descripcion,
        'Email':this.datosVacante.Email,
        'Nombre':this.datosVacante.Nombre,
        'Logo':this.datosVacante.Logo
      });
      console.log(this.editarForm.value)
    })
    
  
  }

  putForm(form: VacantesI){
    this.api.putVacant(form).subscribe(data => {
      console.log(data);
      document.location.href = (`http://localhost:4200/editjob`);
    })
  }

  getToken(){
    return localStorage.getItem('Token')
  }

  eliminar(){
    let datos: VacantesI = this.editarForm.value;
  this.api.deleteVacant(datos).subscribe(data =>{
  console.log(data);
  document.location.href = (`http://localhost:4200/editjob`);
  })
  }

 
 

}
