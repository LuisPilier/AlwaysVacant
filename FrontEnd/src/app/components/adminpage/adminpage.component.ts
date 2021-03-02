import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-adminpage',
  templateUrl: './adminpage.component.html',
  styleUrls: ['./adminpage.component.css']
})
export class AdminpageComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
    if (localStorage.getItem('ID_Rol') != '3') {
      this.RedirigirPorTipoUsuario(localStorage.getItem('ID_Rol'));
    }
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
