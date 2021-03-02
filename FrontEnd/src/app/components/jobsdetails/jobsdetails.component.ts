import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router'
import { VacantesI } from 'src/app/models/vacantes.interface';
import { ApisService } from 'src/app/services/apis.service';
import { CitiesI } from 'src/app/models/cities.interface';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import * as _ from 'lodash';
@Component({
  selector: 'app-jobsdetails',
  templateUrl: './jobsdetails.component.html',
  styleUrls: ['./jobsdetails.component.css']
})
export class JobsdetailsComponent implements OnInit {

  nuevoForm = new FormGroup({
    Nombre: new FormControl('', Validators.required),
    Token: new FormControl('', Validators.required)
  });

  constructor(private activerouter: ActivatedRoute, private http: HttpClient, private router: Router, private api: ApisService) { }
  Title: any;
  City: any;
  Country: any;
  Position: any;
  TipoVacant: any;
  Descripcion: any;
  Email: any;
  Pais: any;
  img: any;
  URL: any;
  //@ts-ignore
  datosCiudades!: CitiesI;
  filterPost = '';
  conversion: [] = [];
  numbeross: [] = [];
  paginactual: number = 1;
  numpag: any;
  confirm: string = "";
  count: number = 0;
  categoria: [] = [];
  ciudad: [] = [];
  paises: [] = [];
  modal: string = "";
  imageError: string = "";
  isImageSaved: boolean = false;
  cardImageBase64: string = "";

  datosJobs!: VacantesI;

  jobForm = new FormGroup({
    Token: new FormControl('', Validators.required),
    Compania: new FormControl(''),
    Ubicacion: new FormControl(''),
    Email: new FormControl(''),
    ID_Categoria: new FormControl(''),
    ID_Ciudad: new FormControl(''),
    ID_Tipo_Vacante: new FormControl(''),
    Posicion: new FormControl(''),
    URL: new FormControl(''),
    Logo: new FormControl(''),
    Codigo_pais: new FormControl(''),
    Descripcion: new FormControl('')
  });

  ngOnInit(): void {
    if (localStorage.getItem('ID_Rol') != '1' && localStorage.getItem('ID_Rol') != '2') {
      this.RedirigirPorTipoUsuario(localStorage.getItem('ID_Rol'));
    } else {
      let ID_Vacante = this.activerouter.snapshot.paramMap.get('ID_Vacante');
      let Token = this.getToken();
      this.api.getUnicoJob(ID_Vacante).subscribe(data => {
        //@ts-ignore
        this.datosJobs = data[0];
        console.log(this.datosJobs)
        this.Title = this.datosJobs.Compania;
        this.City = this.datosJobs.Ciudad;
        this.Country = this.datosJobs.Nombre;
        this.Position = this.datosJobs.Posicion;
        this.TipoVacant = this.datosJobs.TipoVacante;
        this.Descripcion = this.datosJobs.Descripcion;
        this.Email = this.datosJobs.Email;
        this.img = this.datosJobs.Logo;
        this.Pais = this.datosJobs.Nombre;
        this.URL = this.datosJobs.URL;
      })
      this.modal="#formJob";
      this.confirm = "Send";
      this.getNumber();
      this.getData();
      this.getCategory();
      this.getCountry();
      this.nuevoForm.patchValue({
        'Token': Token
      });

      this.jobForm.patchValue({
        'Token': Token
      });
    }
  }

  validateModal() {
    if (localStorage.getItem('ID_Rol') == '2') {
      this.modal="formJob";
      console.log(this.modal)
      return true
    }else{
      this.modal="alert"
      return true
    }
   }
   postForm(form: VacantesI) {
    if (this.count == 0) {
      this.count++;
      this.jobForm.patchValue({
        'Logo': this.cardImageBase64
      });
      this.confirm = "Press another time to confirm"
      let confim = document.getElementById('confirm');
      //@ts-ignore
      confim.className = 'btn btn-danger btn-lg btn-block';
    } else {
      console.log(form);
      this.api.postJob(form).subscribe(data => {
        console.log(data);
        document.location.href = (`https://alwaysvacant.netlify.app/homepagejobs`);
      })
    }
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
        this.ciudad = data
        console.log(data)
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
  volver() {
    document.location.href = (`https://alwaysvacant.netlify.app/homepagejobs`);
  }

  getToken() {
    return localStorage.getItem('Token');
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
