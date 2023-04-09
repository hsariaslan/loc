// import { combineReducers } from 'redux';
// // import your reducers here
// import exampleReducer from './exampleReducer';
//
// // const rootReducer = exampleReducer;
//
// export default exampleReducer;

import { combineReducers } from 'redux'
import userReducer from './userReducer'

export default combineReducers({
    users: userReducer
})
