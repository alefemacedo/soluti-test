const getters = {
  token: state => state.user.token,
  isRefreshing: state => state.user.isRefreshing,
  userId: state => state.user.userId
}
export default getters
  