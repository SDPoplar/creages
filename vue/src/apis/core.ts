import author from "@/utils/auth"
import axios from "axios"

const API_DOMAIN = 'http://creages.sd.virtual'

export const HttpMethods = {
  GET: 'GET',
  POST: 'POST',
  PUT: 'PUT',
  HEAD: 'HEAD',
  OPTIONS: 'OPTIONS',
  DELETE: 'DELETE',
}

export class Api {
  protected method: string
  protected path: string
  protected params: object

  constructor(method: string, path: string, params: object = {}) {
    this.method = method
    this.path = path
    this.params = params
  }

  public async call() {
    let resp = await axios({
      method: this.method,
      url: API_DOMAIN + this.path,
      data: this.params,
      responseType: 'json',
      headers: {
        'Authorization': author.getToken()
      }
    }).catch(reason => {
      if (reason.response.status === 401) {
        author.setToken('')
        Promise.resolve()
      } else {
        return Promise.reject(reason)
      }
    })
    //  console.log(resp)
    return resp
  }
}