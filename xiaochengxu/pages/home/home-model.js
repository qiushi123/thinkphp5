// 首页的model
import {
  Base
} from '../../utils/base.js'
class Home extends Base {
  constructor() {
    super()
  }
  //获取顶部轮播图
  getBannerData(id, callBack) {
    let params = {
      url: 'banner/' + id,
      sCallBack(res) {
        callBack && callBack(res.data.items)
      },
      fCallBack(res) {
        callBack && callBack(res)
      }
    }
    this.baseRequest(params)
  }
  //获取首页主题
  getThemeData(callBack) {
    let params = {
      url: 'theme?ids=1,2,3',
      sCallBack(res) {
        callBack && callBack(res.data)
      },
      fCallBack(res) {
        callBack && callBack(res)
      }
    }
    this.baseRequest(params)
  }
  //获取热门商品
  getProductsData(callBack) {
    let params = {
      url: 'product/recent/15',
      sCallBack(res) {
        callBack && callBack(res.data)
      },
      fCallBack(res) {
        callBack && callBack(res)
      }
    }
    this.baseRequest(params)
  }
}
export {
  Home
};