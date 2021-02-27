import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ApisService } from 'src/app/services/apis.service';
import { Router } from '@angular/router'
@Component({
  selector: 'app-editjob',
  templateUrl: './editjob.component.html',
  styleUrls: ['./editjob.component.css']
})
export class EditjobComponent implements OnInit {



  constructor(private http: HttpClient) { }
  conversion: [] = [];



  ngOnInit(): void {

  }
}
