import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ApisService } from 'src/app/services/apis.service';
import { ResponseI } from 'src/app/models/response.interface';
import { CategoryI } from 'src/app/models/category.interface';
import {VacantadminI} from 'src/app/models/vacanteadmin.interface';
import * as _ from 'lodash';
@Component({
  selector: 'app-homepagejobs',
  templateUrl: './homepagejobs.component.html',
  styleUrls: ['./homepagejobs.component.css']
})
export class HomepagejobsComponent implements OnInit {

  nuevoForm = new FormGroup({
    Nombre: new FormControl('', Validators.required),
    Token: new FormControl('', Validators.required)
  });
  constructor(private http: HttpClient, private api: ApisService) { }
  filterPost = '';
  conversion: [] = [];
  numbeross: [] = [];
  paginactual: number = 1;
  numpag: any;
  categoria: [] = [];
  ciudad: [] = [];
  paises: [] = [];
  imageError: string="";
  isImageSaved: boolean=false;
  cardImageBase64: string="";

  ngOnInit(): void {
    this.getNumber();
    this.getData();
    this.getCategory();
    this.getCountry();
    let Token = localStorage.getItem('Token');
    this.nuevoForm.patchValue({
      'Token': Token
    });
  }

  getData() {
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/vacante.php')
      .subscribe((data: any) => {
        this.conversion = data;
        console.log(this.conversion);
      });
  }
  getNumber() {
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/Usuarios/usuario_admin.php')
      .subscribe((data: any) => {
        this.numpag = data[0].Numero_vacantes;
        console.log(this.numpag);
      });
  }

  getCategory() {
    this.http.get('http://en-linea.app/AlwaysVacant/BackEnd/API/categoria.php')
      .subscribe((data: any) => {
        this.categoria = data;
        console.log(this.categoria);
      })
  }

 /* getCity() {
    this.http.get('http://en-linea.app/AlwaysVacant/BackEnd/API/ciudades.php')
      .subscribe((data: any) => {
        this.ciudad = data;
        console.log(this.ciudad);
      })
  }*/
  getCountry() {
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/Localidades/paises.php')
      .subscribe((data: any) => {
        this.paises = data;
        console.log(this.paises);
      })
  }
  handleChange(pais:any) {
    console.log("aasd" + pais)
 }
}
