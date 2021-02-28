import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ApisService } from 'src/app/services/apis.service';
import {Router} from '@angular/router'


@Component({
  selector: 'app-editjob',
  templateUrl: './editjob.component.html',
  styleUrls: ['./editjob.component.css']
})
export class EditjobComponent implements OnInit {
  


  constructor(private http: HttpClient) { }
  conversion: [] = [];
  paginactual: number = 1;
 

  ngOnInit(): void {
   this.getData();
  }
  getData(){
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/vacante.php')
    .subscribe((data:any) => { 
     this.conversion=data;
     console.log( this.conversion );
    });
  }
  
  
  

}
