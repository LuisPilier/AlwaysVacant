import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ApisService } from 'src/app/services/apis.service';

@Component({
  selector: 'app-allvacants',
  templateUrl: './allvacants.component.html',
  styleUrls: ['./allvacants.component.css']
})
export class AllvacantsComponent implements OnInit {

nuevoForm = new FormGroup({
  Nombre: new FormControl('', Validators.required),
  Token: new FormControl('', Validators.required)
});
constructor(private http: HttpClient, private api: ApisService) { }
filterPost = '';
conversion: [] = [];
paginactual: number = 1; 

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
