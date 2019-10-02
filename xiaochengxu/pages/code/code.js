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
  getToken(wxCode){
    wx.request({
      url: 'http://localhost:9001/public/api/v1/user/token',
      method:'post',
      data: {
        code: wxCode
      },
      success(res) {
        console.log('获取成功', res.data.token)
      },
      fail(res) {
        console.log('获取失败', res)
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