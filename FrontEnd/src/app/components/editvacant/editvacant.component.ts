import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { VacantesI } from 'src/app/models/vacantes.interface';
import { ApisService } from 'src/app/services/apis.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import * as _ from 'lodash';
@Component({
  selector: 'app-editvacant',
  templateUrl: './editvacant.component.html',
  styleUrls: ['./editvacant.component.css']
})
export class EditvacantComponent implements OnInit {

  constructor(private activerouter: ActivatedRoute, private router: Router, private api: ApisService, private http: HttpClient) { }
  Ciudad: [] = [];
  paises: [] = [];
  categoria: [] = [];
  imageError: string = "";
  isImageSaved: boolean = false;
  cardImageBase64: string = "";
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
    URL: new FormControl(''),
    Descripcion: new FormControl(''),
    Logo: new FormControl(''),
    Email: new FormControl(''),
    Nombre: new FormControl(''),
    ID_Vacante: new FormControl(''),
    Codigo_Pais: new FormControl('')
  })

  ngOnInit(): void {
    if (localStorage.getItem('ID_Rol') != '3') {
      this.RedirigirPorTipoUsuario(localStorage.getItem('ID_Rol'));
    } else {
      this.getCategory();
      this.getCountry();
      let ID_Vacante = this.activerouter.snapshot.paramMap.get('ID_Vacante');
      let Token = this.getToken();
      this.api.getUnicaVacante(ID_Vacante).subscribe(data => {

        //@ts-ignore
        this.datosVacante = data[0];
        //@ts-ignore
        console.log(data[0])

        this.onChange(this.datosVacante.Codigo_Pais)
        this.isImageSaved = true;
        this.cardImageBase64 = "https://" + this.datosVacante.Logo
        this.editarForm.setValue({
          'Token': Token,
          'Compania': this.datosVacante.Compania,
          'ID_Tipo_Vacante': this.datosVacante.ID_Tipo_Vacante,
          'Posicion': this.datosVacante.Posicion,
          'Ubicacion': this.datosVacante.Ubicacion,
          'ID_Categoria': this.datosVacante.ID_Categoria,
          'URL': this.datosVacante.URL,
          'ID_Vacante': ID_Vacante,
          'Descripcion': this.datosVacante.Descripcion,
          'Codigo_Pais': this.datosVacante.Codigo_Pais,
          'Email': this.datosVacante.Email,
          'Nombre': this.datosVacante.Nombre,
          'Logo': "",
          'ID_Ciudad': this.datosVacante.ID_Ciudad
        });
        console.log(this.editarForm.value)
      })
    }

  }

  putForm(form: VacantesI) {
    console.log(form)
    this.api.putVacant(form).subscribe(data => {
      console.log(data);
      document.location.href = (`https://alwaysvacants.000webhostapp.com/editjob`);
    })
  }
  confirmando() {
    console.log()
    this.editarForm.patchValue({
      'Logo': this.cardImageBase64
    });
  }

  getToken() {
    return localStorage.getItem('Token')
  }

  eliminar() {
    let datos: VacantesI = this.editarForm.value;
    this.api.deleteVacant(datos).subscribe(data => {
      console.log(data);
      document.location.href = (`https://alwaysvacants.000webhostapp.com/editjob`);
    })
  }
  getCategory() {
    this.http.get('http://en-linea.app/AlwaysVacant/BackEnd/API/categoria.php')
      .subscribe((data: any) => {
        this.categoria = data;
        console.log(this.categoria);
      })
  }

  getCountry() {
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/Localidades/paises.php')
      .subscribe((data: any) => {
        this.paises = data;
        console.log(this.paises);
      })
  }

  onChange(Codigo_Pais: any) {
    this.http.get('http://en-linea.app/AlwaysVacant/BackEnd/API/Localidades/ciudades.php?Codigo_pais=' + Codigo_Pais)
      .subscribe((data: any) => {
        this.Ciudad = data;
        console.log(data);
      })
  }
  fileChangeEvent(fileInput: any) {
    this.imageError = "";
    if (fileInput.target.files && fileInput.target.files[0]) {
      // Size Filter Bytes
      const max_size = 20971520;
      const allowed_types = ['image/png', 'image/jpeg'];
      const max_height = 15200;
      const max_width = 25600;

      if (fileInput.target.files[0].size > max_size) {
        this.imageError =
          'Maximum size allowed is ' + max_size / 1000 + 'Mb';

        return false;
      }

      if (!_.includes(allowed_types, fileInput.target.files[0].type)) {
        this.imageError = 'Only Images are allowed ( JPG | PNG )';
        return false;
      }
      const reader = new FileReader();
      reader.onload = (e: any) => {
        const image = new Image();
        image.src = e.target.result;
        image.onload = rs => {
          //@ts-ignore
          const img_height = rs.currentTarget['height'];
          //@ts-ignore
          const img_width = rs.currentTarget['width'];

          console.log(img_height, img_width);


          if (img_height > max_height && img_width > max_width) {
            this.imageError =
              'Maximum dimentions allowed ' +
              max_height +
              '*' +
              max_width +
              'px';
            return false;
          } else {
            const imgBase64Path = e.target.result;
            this.cardImageBase64 = imgBase64Path;
            this.isImageSaved = true;
            return true;
            //this.previewImagePath = imgBase64Path;
          }
        };
      };
      reader.readAsDataURL(fileInput.target.files[0]);
    }
    return false;
  }

  removeImage() {
    this.cardImageBase64 = "";
    this.isImageSaved = false;
  }
  RedirigirPorTipoUsuario(id_rol: any) {
    console.log(id_rol)
    switch (id_rol) {
      case "1":
        document.location.href = (`https://alwaysvacants.000webhostapp.com/homepagejobs`);
        break;
      case "2":
        document.location.href = (`https://alwaysvacants.000webhostapp.com/homepagejobs`);
        break;
      case "3":
        document.location.href = (`https://alwaysvacants.000webhostapp.com/adminpage`);
        break;
      default:
        document.location.href = (`https://alwaysvacants.000webhostapp.com/homepage`);
    }
  }

}
