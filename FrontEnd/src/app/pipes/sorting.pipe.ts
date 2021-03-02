import { Pipe, PipeTransform } from '@angular/core';
import * as _ from'underscore';

@Pipe({
  name: 'sorting'
})
export class SortingPipe implements PipeTransform {

  transform(value:Array<any>): any {
    if(!value) return[]
    return _.sortBy(value, function(categoria){return categoria.Nombre;})
  }

}