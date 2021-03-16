import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HomepagejobsComponent } from './homepagejobs.component';

describe('HomepagejobsComponent', () => {
  let component: HomepagejobsComponent;
  let fixture: ComponentFixture<HomepagejobsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ HomepagejobsComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(HomepagejobsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
