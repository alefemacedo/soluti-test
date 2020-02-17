const getters = {
  token: state => state.user.token,
  isRefreshing: state => state.user.isRefreshing,
  userId: state => state.user.userId,
  user: state => state.user.userName
}
export default getters
  