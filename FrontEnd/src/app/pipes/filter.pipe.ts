import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'filter'
})
export class FilterPipe implements PipeTransform {

  transform(value: any, arg: any): any {
    if (arg == '' || arg.length < 3) return value;
    const resultPosts = [];
    for (const post of value)
    {
      if (post.Ciudad.toLowerCase().indexOf(arg.toLowerCase()) > -1)
      {
        resultPosts.push(post);     
      };
      if (post.Categoria.toLowerCase().indexOf(arg.toLowerCase()) > -1)
      {
        resultPosts.push(post);     
      };
      if (post.Compania.toLowerCase().indexOf(arg.toLowerCase()) > -1)
      {
        resultPosts.push(post);     
      };
    };
    return resultPosts;
  }

}
