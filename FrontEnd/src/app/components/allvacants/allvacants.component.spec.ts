import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AllvacantsComponent } from './allvacants.component';

describe('AllvacantsComponent', () => {
  let component: AllvacantsComponent;
  let fixture: ComponentFixture<AllvacantsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AllvacantsComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AllvacantsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
