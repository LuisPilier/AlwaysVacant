import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ApisService } from 'src/app/services/apis.service';
import { ResponseI } from 'src/app/models/response.interface';
import { CategoryI } from 'src/app/models/category.interface';
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
 
  paginactual: number = 1;
  numpag: number = 10; 

  ngOnInit(): void {
    this.getData();
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
}
