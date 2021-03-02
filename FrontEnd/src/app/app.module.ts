import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';


import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { HomepageComponent } from './components/homepage/homepage.component';
import { AdminpageComponent } from './components/adminpage/adminpage.component';
import { NoopAnimationsModule } from '@angular/platform-browser/animations';
import { PagepostjobComponent } from './components/pagepostjob/pagepostjob.component';
import { SidebarComponent } from './components/sidebar/sidebar.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { EditjobComponent } from './components/editjob/editjob.component';
import { CreatecategoryComponent } from './components/createcategory/createcategory.component';
import { NumberofjobComponent } from './components/numberofjob/numberofjob.component';
import { HomepagejobsComponent } from './components/homepagejobs/homepagejobs.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { JobsdetailsComponent } from './components/jobsdetails/jobsdetails.component';
import { AllvacantsComponent } from './components/allvacants/allvacants.component';



import { HttpClientModule, HttpClient } from '@angular/common/http';
import { HeaderadminComponent } from './components/headeradmin/headeradmin.component';

import { NgxPaginationModule } from 'ngx-pagination';
import { FilterPipe } from './pipes/filter.pipe';
import { EditvacantComponent } from './components/editvacant/editvacant.component';
import { EditcategoryComponent } from './components/editcategory/editcategory.component';
import { SortingPipe } from './pipes/sorting.pipe';



@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    HomepageComponent,
    AdminpageComponent,
    PagepostjobComponent,
    SidebarComponent,
    EditjobComponent,
    CreatecategoryComponent,
    NumberofjobComponent,
    HomepagejobsComponent,
    JobsdetailsComponent,
    HeaderadminComponent,
    FilterPipe,
    EditvacantComponent,
    EditcategoryComponent,
    AllvacantsComponent,
    SortingPipe,
    

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NoopAnimationsModule,
    FontAwesomeModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    NgxPaginationModule,
  
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
