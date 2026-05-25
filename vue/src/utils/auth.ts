import PubSub from "pubsub-js"
import PubSubEvents from "@/PubSubEvents"

const TOKEN_STORAGE_KEY = 'auth_token'

class authManager {
  private authed: boolean = false
  private token: string = ''

  constructor() {
    this.token = localStorage.getItem(TOKEN_STORAGE_KEY) ?? ''
    this.authed = this.token.length > 0
  }

  public isAuthed(): boolean {
    return this.authed
  }

  public getToken(): string
  {
    return this.token
  }

  public setToken(newToken: string) {
    this.token = newToken
    if (newToken.length > 0) {
      localStorage.setItem(TOKEN_STORAGE_KEY, newToken)
    } else {
      localStorage.removeItem(TOKEN_STORAGE_KEY)
    }
    this.authed = this.token.length > 0
    PubSub.publish(PubSubEvents.AUTH_TOKEN_CHANGED, {token: newToken, authed: this.authed})
  }
}

const author = new authManager()

export default author