import { Api, HttpMethods } from "./core";

export default class VerifyToken extends Api {
  constructor() {
    super(HttpMethods.GET, '/auth')
  }
}