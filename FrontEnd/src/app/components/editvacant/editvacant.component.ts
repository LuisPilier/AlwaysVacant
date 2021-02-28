import { Component, OnInit } from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {VacanteI} from 'src/app/models/Vacante.interface';
import {ApisService} from 'src/app/services/apis.service';
import {FormGroup, FormControl, Validators} from '@angular/forms';



@Component({
  selector: 'app-editvacant',
  templateUrl: './editvacant.component.html',
  styleUrls: ['./editvacant.component.css']
})
export class EditvacantComponent implements OnInit {

  constructor(private activerouter: ActivatedRoute, private router: Router, private api: ApisService) { }
//@ts-ignore
 datosVacante: VacanteI;
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
  Logo: new FormControl('')
 })

  ngOnInit(): void {
    let vacanteid = this.activerouter.snapshot.paramMap.get('ID_Vacante');
    let Token = this.getToken();
    this.api.getUnicaVacante(vacanteid).subscribe(data =>{
      //@ts-ignore
      this.datosVacante = data[0];
      console.log(this.datosVacante);
    })
  }

  getToken(){
    return localStorage.getItem('Token');
  }

}
