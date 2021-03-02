import { Component, OnInit } from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router'
import {VacantesI} from 'src/app/models/vacantes.interface';
import {ApisService} from 'src/app/services/apis.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
@Component({
  selector: 'app-jobsdetails',
  templateUrl: './jobsdetails.component.html',
  styleUrls: ['./jobsdetails.component.css']
})
export class JobsdetailsComponent implements OnInit {

  constructor(private activerouter:ActivatedRoute, private router: Router, private api: ApisService) { }
 Title: any;
 City: any;
 Country: any;
 Position: any;
 TipoVacant: any;
 Descripcion: any;
 Email: any;
 img: any;
 datosJobs!: VacantesI;

  ngOnInit(): void {
    let ID_Vacante = this.activerouter.snapshot.paramMap.get('ID_Vacante');
    let Token = this.getToken();
    this.api.getUnicoJob(ID_Vacante).subscribe(data =>{
      //@ts-ignore
      this.datosJobs = data[0];
      this.Title = this.datosJobs.Compania;
      this.City = this.datosJobs.Ciudad;
     this.Country = this.datosJobs.Nombre;
     this.Position = this.datosJobs.Posicion;
     this.TipoVacant = this.datosJobs.TipoVacante;
     this.Descripcion = this.datosJobs.Descripcion;
     this.Email = this.datosJobs.Email;
     this.img = this.datosJobs.Logo;
    })
  }

  volver(){
    document.location.href = (`http://localhost:4200/homepagejobs`);
  }

  getToken(){
    return localStorage.getItem('Token');
  }

}
