//老师微信：2501902696
Page({
  getCode() {
    let that = this;
    wx.login({
      success(res) {
        console.log('code', res.code)
        that.getToken(res.code)
      }
    })
  },
  getToken(wxCode) {
    wx.request({
      url: 'http://localhost:9001/public/api/v1/user/token',
      method: 'post',
      data: {
        code: wxCode
      },
      success(res) {
        console.log('获取成功', res.data.token)
        wx.setStorageSync('token', res.data.token)
      },
      fail(res) {
        console.log('获取失败', res)
      }
    })
  },

  goPay() {
    let that = this
    let token = wx.getStorageSync('token')
    if (token) {
      wx.request({
        url: 'http://localhost:9001/public/api/v1/pay/pre_order',
        method: 'post',
        header: {
          token: token
        },
        data: {
          id: 10
        },
        success(res) {
          console.log('获取支付参数成功', res.data)
          that.wxappPay(res.data)
        },
        fail(res) {
          console.log('获取支付参数失败', res)
        }
      })
    } else {
      wx.showToast({
        title: 'token过期或不存在',
        icon: 'none'
      })
    }
  },
  //小程序支付
  wxappPay(data) {
    wx.requestPayment({
      timeStamp: data.timeStamp,
      nonceStr: data.nonceStr,
      package: data.package,
      signType: 'MD5',
      paySign: data.paySign,
      success(res) {
        console.log('支付成功', res)
      },
      fail(res) {
        console.log('支付失败', res)
      }
    })
  },
  getOpenid(wxCode) {
    wx.request({
      url: 'http://localhost:8080/Demo.php',
      data: {
        code: wxCode
      },
      success(res) {
        console.log('获取成功', res)
      },
      fail(res) {
        console.log('获取失败', res)
      }
    })
  }
})