import{Config}from'../utils/config.js'
class Base {
  constructor() {
    this.baseUrl = Config.restUrl
  }

  baseRequest(params) {
    var url = this.baseUrl + params.url
    wx.request({
      url: url,
      data: params.data,
      header: {
        'content-type': 'application/json',
        'token': wx.getStorageSync('token')
      },
      method: params.type ? params.type : 'GET',
      // dataType: 'json',
      // responseType: 'text',
      success: function(res) {
        params.sCallBack && params.sCallBack(res)
      },
      fail: function(res) {
        params.fCallBack && params.fCallBack(res)
      },
      // complete: function(res) {},
    })
  }
}
export{Base}