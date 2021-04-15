import { Information } from '@service/information.service';
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Http, Headers, ResponseOptions } from '@angular/http';
import { Router } from '@angular/router';
import 'rxjs/add/operator/map';

@Injectable()
export class ApiService {

    constructor(private http: HttpClient, private post: Http, private router: Router, private infor: Information) { }
    postApi(_Gatewey: string, ..._Obj: Array<any>) {
        let postData = (el: any) => {
            let keys = Object.keys(el);
            let data = new FormData();
            for (let i = 0; i < keys.length; i++) {
                data.append(keys[i], el[keys[i]]);
            }
            return data;
        }
        let geturl = el => { return 'assets/json/' + el + '.json' };
        let url = geturl(_Gatewey);
        switch (_Gatewey) {
            case 'formdata':
                let $obj = postData(_Obj[0]);
                url = '/forms/u/0/d/e/1FAIpQLSdWJlLDYntz5U423tsDTrXMa4hkfxc7sw3J0-f2f59wbRjaEA/formResponse';
                let headers = new Headers({ 'Access-Control-Allow-Origin': '*' });
                let options = new ResponseOptions({ headers: headers });
                return this.post.post(url, $obj, options).map(el => { return el; });
            case 'member':
                this.http.get(url).subscribe((el: any) => {
                    let username = el.map(res => { return res.username }).indexOf(_Obj[0].username) !== -1;
                    let password = el.map(res => { return res.password }).indexOf(_Obj[0].password) !== -1;
                    if (username && password) { localStorage.setItem('login', _Obj[0].username); }
                    else { localStorage.removeItem('login'); }
                    return this.router.navigate(['/Member']);
                })
            default:
                return this.http.get(url).map(el => { return el; });
        }
    }
}
