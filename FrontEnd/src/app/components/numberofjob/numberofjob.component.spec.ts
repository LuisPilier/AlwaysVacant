import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NumberofjobComponent } from './numberofjob.component';

describe('NumberofjobComponent', () => {
  let component: NumberofjobComponent;
  let fixture: ComponentFixture<NumberofjobComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ NumberofjobComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(NumberofjobComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
