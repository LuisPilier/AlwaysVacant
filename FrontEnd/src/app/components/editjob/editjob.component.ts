import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ApisService } from 'src/app/services/apis.service';
@Component({
  selector: 'app-editjob',
  templateUrl: './editjob.component.html',
  styleUrls: ['./editjob.component.css']
})
export class EditjobComponent implements OnInit {

  constructor(private api: ApisService) { }
 
 

  ngOnInit(): void {
    this.api.getAllData().subscribe(data =>{
      console.log(data);
    })
  }

  
  

}
