import {
  Home
} from 'home-model.js'
var home = new Home()
Page({

  data: {
    bannerList: [],
    themeList: [],
    productList: []
  },

  onLoad: function(options) {
    this._loadData();
  },

  _loadData() {
    home.getBannerData(1, (res) => {
      console.log('首页顶部轮播图', res)
      this.setData({
        bannerList: res
      })
    });
    home.getThemeData((res) => {
      console.log('首页主题', res)
      this.setData({
        themeList: res
      })
    });
    home.getProductsData((res) => {
      console.log('热门商品', res)
      this.setData({
        productList: res
      })
    })

  }

})