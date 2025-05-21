import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import Home from './app/Home'
import SignIn from './app/SignIn'
import SignUp from './app/SignUp'
import Manager from './app/admin/Manager'

import { BrowserRouter, Routes, Route } from 'react-router-dom'
import { Provider } from 'react-redux'
import Store from './app/redux/Store'
import { PersistGate } from 'redux-persist/integration/react'

const {store, persistor} = Store()

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <Provider store={store}>
    <PersistGate loading={null} persistor={persistor}>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<Home />} />
          <Route path='/signin' element={<SignIn />} />
          <Route path='/signup' element={<SignUp />} />
          <Route path='/manager/user/:id' element={<Manager />} />
        </Routes>
      </BrowserRouter>
      </PersistGate>
    </Provider>
  </StrictMode>,
)
