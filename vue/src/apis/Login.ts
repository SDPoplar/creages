import { HttpMethods, Api } from "./core";

export default class Login extends Api {
  constructor(account: string, password: string) {
    super(HttpMethods.POST, '/auth/pwd', {account: account, password: password})
  }
}