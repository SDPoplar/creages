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
  protected dataType: string = 'application/x-www-form-urlencoded'

  constructor(method: string, path: string, params: object = {}) {
    this.method = method
    this.path = path
    this.params = params
  }

  protected setMultipart() {
    this.dataType = 'multipart/form-data'
  }

  public async call() {
    let resp = await axios({
      method: this.method,
      url: API_DOMAIN + this.path,
      data: this.params,
      responseType: 'json',
      headers: {
        'Content-Type': this.dataType,
        'Authorization': author.getToken()
      }
    }).catch(reason => {
      if ((typeof(reason.response) !== 'undefined') && (reason.response.status === 401)) {
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